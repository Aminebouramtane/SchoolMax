<?php

namespace App\Repository;


interface GraduatRepositoryInterface {

    public function getGraduat();
    public function createGraduat();
    public function SoftDelete($request);
    public function Restore($request);
    public function destroy($id);
    public function RestoreAll();

}