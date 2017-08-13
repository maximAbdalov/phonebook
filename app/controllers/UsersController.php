<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Mvc\View;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UsersController extends ControllerBase
{
	const ITEMS_ON_PAGE = 10;

	/**
	 * index action for users
	 */
	public function indexAction()
	{
		$this->view->page = $this->getList();
	}


	public function newAction()
	{

	}

	/**
	 * Displays the creation form
	 */
	public function ajaxGetTableAction()
	{
		$view = new View();

		// Setting views directory
		$view->setViewsDir("app/views/");

		$view->start();

		// Shows recent posts view (app/views/posts/recent.phtml)
		$view->render("users", "ajax");
		$view->finish();

		// Printing views output
		echo $view->getContent();
	}

	/**
	 * Edits a user
	 *
	 * @param string $id
	 */
	public function editAction($id)
	{
		if (!$this->request->isPost()) {
			$user = Users::findFirstByid($id);
			if (!$user)
				return false;

			$this->view->id = $user->id;
			$phones = [];
			if ($user->phones) {
				foreach ($user->phones as $p) {
					$phones[] = $p->phone;
				}
			}
			$this->view->phones = $phones;
			$this->tag->setDefault("id", $user->id);
			$this->tag->setDefault("fio", $user->fio);
			$this->tag->setDefault("notes", $user->notes);
		}
	}

	/**
	 * Creates a new user
	 */
	public function createAction()
	{
		if (!$this->request->isPost())
			return false;

		$user = new Users();
		$user->fio = $this->request->getPost("fio");
		$user->notes = $this->request->getPost("notes");
		$phones = $this->request->getPost('phones');
		$user->created_at = date('Y-m-d H:i:s');
		$user->updatet_at = date('Y-m-d H:i:s');

		if (!$user->save())
			return false;

		if ($phones) {
			foreach ($phones as $phone) {
				$phoneModel = new Phones();
				$phoneModel->phone = $phone;
				$phoneModel->users = $user;
				$phoneModel->save();
			}
		}
		return true;
	}

	/**
	 * Saves a user edited
	 *
	 */
	public function saveAction()
	{
		$id = $this->request->getPost("id");
		$user = Users::findFirstByid($id);

		if (!$user)
			return false;

		$user->fio = $this->request->getPost("fio");
		$user->notes = $this->request->getPost("notes");
		$user->updatet_at = date('Y-m-d H:i:s');
		$phones = $this->request->getPost('phones');

		if (!$user->save())
			return false;

		$user->getPhones()->delete();
		if ($phones) {
			foreach ($phones as $phone) {
				$phoneModel = new Phones();
				$phoneModel->phone = $phone;
				$phoneModel->users = $user;
				$phoneModel->save();
			}
		}
		return true;
	}

	public function ajaxAction()
	{
		$this->view->page = $this->getList();
	}

	/**
	 * Deletes a user
	 *
	 * @param string $id
	 */
	public function deleteAction($id)
	{
		$user = Users::findFirstByid($id);
		if ($user) {
			$user->getPhones()->delete();
			return $user->delete();
		}
		return false;
	}

	private function getList()
	{
		$numberPage = $this->request->getQuery("page", "int");

		$users = Users::find(['order' => 'updatet_at DESC']);

		if (!count($users))
			$this->flash->notice("Контактов не найдено");

		$paginator = new Paginator([
			'data' => $users,
			'limit' => self::ITEMS_ON_PAGE,
			'page' => $numberPage
		]);

		return $paginator->getPaginate();
	}

}
