<?php

namespace App\Controllers;
// use App\Models\VehicleModel;
// // use App\Models\UserModel;
// use CodeIgniter\Controller;
class Dashboard extends BaseController
{

    function __construct(){
        $this->session = session();
    }

    public function index()
    {
        $item = $this->session->get('user_id');

        if($item) {
            return view('home');
        }
        else{
            return redirect()->to('/');
        }
        
    }

    public function show() {
        // if($this->request->getMethod() == 'post'){
            $VehicleModel = new \App\Models\VehicleModel();
            $userid = $this->session->get('user_id');
            $result = $VehicleModel->getVehicles($userid);
            // dd($result);
            return $this->response->setJson($result);
        // }
    }

    public function create() {
        $VehicleModel = new \App\Models\VehicleModel();
        $userid = $this->session->get('user_id');
        $vName = $this->request->getPost('vName');
        $vType = $this->request->getPost('vType');
        $yom = $this->request->getPost('yom');
        $dop = $this->request->getPost('dop');

        $result = $VehicleModel->insertData($userid, $vName, $vType, $yom ,$dop);

        return $this->response->setJSON($result);
    }

    public function delete() {
        $VehicleModel = new \App\Models\VehicleModel();
        $userid = $this->session->get('user_id');
        $vehicle_id = $this->request->getVar('vehicle_id');

        $result = $VehicleModel->deleteData($userid, $vehicle_id);

        return $this->response->setJSON($result);
    }

    public function update() {
        $VehicleModel = new \App\Models\VehicleModel();
        $userid = $this->session->get('user_id');
        $vehicle_id = $this->request->getPost('vehicle_id');
        $vName = $this->request->getPost('vName');
        $vType = $this->request->getPost('vType');
        $yom = $this->request->getPost('yom');
        $dop = $this->request->getPost('dop');

        // $a = [$userid, $vehicle_id, $vName, $vType, $yom, $dop];

        $result = $VehicleModel->updateData($userid, $vehicle_id, $vName, $vType, $yom ,$dop);

        return $this->response->setJSON($result);
    }

    public function getUpdateData() {
        $VehicleModel = new \App\Models\VehicleModel();
        $userid = $this->session->get('user_id');
        $vehicle_id = $this->request->getVar('vehicle_id');

        $result = $VehicleModel->getUpdateData($userid, $vehicle_id);

        return $this->response->setJSON($result);
    }
}