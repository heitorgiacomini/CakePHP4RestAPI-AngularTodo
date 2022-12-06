<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

class EmployeeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Employees");
    }

    // Add employee api
    public function addEmployee()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        // email address check rules
        $empData = $this->Employees->find()->where([
            "email" => $formData['email']
        ])->first();

        if (!empty($empData)) {
            // already exists
            $status = false;
            $message = "Email address already exists";
        } else {
            // insert new employee
            $empObject = $this->Employees->newEmptyEntity();

            $empObject = $this->Employees->patchEntity($empObject, $formData);

            if ($this->Employees->save($empObject)) {
                // success response
                $status = true;
                $message = "Employee has been created";
            } else {
                // error response
                $status = false;
                $message = "Failed to create employee";
            }
        }

        $this->set([
            "status" => $status,
            "message" => $formData
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Update employee
    public function updateEmployee()
    {
        $this->request->allowMethod(["put", "post"]);

        $emp_id = $this->request->getParam("id");

        $employeeInfo = $this->request->getData();

        // employee check
        $employee = $this->Employees->get($emp_id);

        if (!empty($employee)) {
            // employees exists

            $employee = $this->Employees->patchEntity($employee, $employeeInfo);
            if ($this->Employees->save($employee)) {
                // success response
                $status = true;
                $message = "Employee has been updated";

            } else {
                // error response
                $status = false;
                $message = "Failed to update employee";
            }
        } else {
            // employee not found
            $status = false;
            $message = "Employee Not Found";
        }

        $this->set([
            "status" => $status,
            "message" =>  $employee
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Get By Id
    public function getByIdEmployee()
    {
        $this->request->allowMethod(["get"]);

        $emp_id = $this->request->getParam("id");

        $employee = $this->Employees->get($emp_id);


        $this->set([
            "status" => true,
            "message" => "Employee",
            "data" => $employee
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // List employees api
    public function listEmployees()
    {
        $this->request->allowMethod(["get"]);

        $employees = $this->Employees->find()->toList();

        $this->set([
            "status" => true,
            "message" => "Employee list",
            "data" => $employees
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Delete employee api
    public function deleteEmployee()
    {
        $this->request->allowMethod(["delete"]);

        $emp_id = $this->request->getParam("id");

        $employee = $this->Employees->get($emp_id);

        if (!empty($employee)) {
            // employee found
            if ($this->Employees->delete($employee)) {
                // employee deleted
                $status = true;
                $message = "Employee has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete employee";
            }
        } else {
            // not found
            $status = false;
            $message = "Employee doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }
}
