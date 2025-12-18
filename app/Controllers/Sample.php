<?php

namespace App\Controllers;

use App\Models\SampleModel;
use CodeIgniter\RESTful\ResourceController;

class Sample extends ResourceController
{
    protected $modelName = SampleModel::class;
    protected $format    = 'json';

    // GET /sample
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    // GET /sample/{id}
    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $data
            ? $this->respond($data)
            : $this->failNotFound("No data found with id $id");
    }

    // POST /sample
    public function create()
    {
        $data = $this->request->getJSON(true);
        if (!$data) return $this->fail('Invalid input');

        if ($this->model->insert($data))
            return $this->respondCreated(['message' => 'Data created successfully']);

        return $this->failServerError('Failed to create data');
    }

    // PUT/PATCH /sample/{id}
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (!$data || !$id) return $this->fail('Invalid input');

        $data['id'] = $id;

        if ($this->model->save($data))
            return $this->respond(['message' => 'Data updated successfully']);

        return $this->failServerError('Failed to update data');
    }

    // DELETE /sample/{id}
    public function delete($id = null)
    {
        if (!$this->model->find($id))
            return $this->failNotFound("No data found with id $id");

        $this->model->delete($id);

        return $this->respondDeleted(['message' => 'Data successfully deleted']);
    }


     public function getUploadCode($length = 16)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= strtolower($characters[rand(0, strlen($characters) - 1)]);
        }
        return $randomString;
    }

    public function upload_photo()
    {
        $id = $this->request->getVar("id");

        $file = $this->request->getFile('file');
        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'Error while uploading');
        }

        $targetDir = 'public/assets/uploads/';
        $newName = $this->getUploadCode() . mt_rand(10000000,99999999) . date('Ymdhis') . '.' . $file->getExtension();

        // Move file
        $file->move($targetDir, $newName);

        // Save to DB
        $model = new SampleModel();
        $model->update_info(['id' => $id], [
            'photo' => $newName
        ]);

        return redirect()->back()->with('success', 'Successfully uploaded');
    }

    
}
