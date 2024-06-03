<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class UserController extends ResourceController
{
    
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $model = new UserModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No author found');
        }
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = $this->validate([
            'author' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        if(!$validation) {
            $response = [
                'message' => $this->validator->getErrors()];

                return $this->failValidationErrors($response);
        }

        $model = new UserModel();
        $data = [
            'author' => esc($this->request->getVar('author')),
            'title' => esc($this->request->getVar('title')),
            'content' => esc($this->request->getVar('content')),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data created successfully'
            ]
        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        // $validation = $this->validate([
        //     'author' => 'required',
        //     'title' => 'required',
        //     'content' => 'required',
        // ]);

        // if(!$validation) {
        //     $response = [
        //         'message' => $this->validator->getErrors()];

        //         return $this->failValidationErrors($response);
        // }


   $model = new UserModel();
   $id = $this->request->getVar('id');
    $data = [
       'author' => $this->request->getVar('author'),
         'title' => $this->request->getVar('title'),
          'content' => $this->request->getVar('content'),
    ];
       $model->where($id, $data)->update($id, $data);
    $response = [
       'status'   => 200,
      'error'    => null,
        'messages' => [
          'success' => 'User updated successfully'
      ]
 ];
      return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $model = new UserModel();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Author successfully deleted!'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Author Not Found!');
        }
    }
}
