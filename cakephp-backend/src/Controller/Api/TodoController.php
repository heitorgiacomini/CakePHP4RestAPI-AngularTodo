<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Todo Controller
 *
 * @property \App\Model\Table\TodoTable $Todo
 */
class TodoController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Todo");
    }

    // Add todo api
    public function addTodo()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        // insert new todo
        $empObject = $this->Todo->newEmptyEntity();

        $empObject = $this->Todo->patchEntity($empObject, $formData);

        if ($this->Todo->save($empObject)) {
            // success response
            $status = true;
            $message = "Todo has been created";
        } else {
            // error response
            $status = false;
            $message = "Failed to create todo";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Get By Id
    public function getByIdTodo()
    {
        $this->request->allowMethod(["get"]);

        $emp_id = $this->request->getParam("id");

        $todo = $this->Todo->get($emp_id);

        $content = json_encode($todo);

        $this->response = $this->response->withStringBody($content);
        $this->response = $this->response->withType('json');
        // ...

        return $this->response;

        // $this->set([
        //     "status" => true,
        //     "message" => "Todo",
        //     "data" => $todo
        // ]);

        // $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // List todo api
    public function listTodo()
    {
        $this->request->allowMethod(["get"]);

        $todo = $this->Todo->find()->toList();

        // $this->set(["a" => $todo]);

        // $this->viewBuilder()->setOption("serialize", ["data"]);

        // $this->set(['my_response' => $todo]);

        // $this->viewBuilder()->setOption('serialize', true);
        // $this->RequestHandler->renderAs($this, 'json');

        $content = json_encode($todo);

        $this->response = $this->response->withStringBody($content);
        $this->response = $this->response->withType('json');
        // ...

        return $this->response;
    }

    // Update todo
    public function updateTodo()
    {
        $this->request->allowMethod(["put", "post"]);

        $emp_id = $this->request->getParam("id");

        $todoInfo = $this->request->getData();

        // todo check
        $todo = $this->Todo->get($emp_id);

        if (!empty($todo)) {
            // todo exists
            $todo = $this->Todo->patchEntity($todo, $todoInfo);

            if ($this->Todo->save($todo)) {
                // success response
                $status = true;
                $message = "Todo has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update todo";
            }
        } else {
            // todo not found
            $status = false;
            $message = "Todo Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $todoInfo
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Delete todo api
    public function deleteTodo()
    {
        $this->request->allowMethod(["delete"]);

        $emp_id = $this->request->getParam("id");

        $todo = $this->Todo->get($emp_id);

        if (!empty($todo)) {
            // todo found
            if ($this->Todo->delete($todo)) {
                // todo deleted
                $status = true;
                $message = "Todo has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete todo";
            }
        } else {
            // not found
            $status = false;
            $message = "Todo doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }
}
