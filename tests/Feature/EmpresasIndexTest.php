<?php

namespace Tests\Feature;

use App\Models\Empresa;
use Tests\FeatureTestCase;


class EmpresaIndexTest extends FeatureTestCase
{
    const PETITION = 'api/empresas';

    public function testIndexReturnAllForAdmin()
    {
        $this->seed();
        $this->actingAsRol(self::ADMIN_ROL);
        $items = $this->getDataFromJson('GET',self::PETITION);
        $this->assertEquals(count($items),count(Empresa::all()));
    }
    public function testIndexReturnAllForResponsable()
    {
        $this->seed();
        $this->actingAsRol(self::RESPONSABLE_ROL);
        $items = $this->getDataFromJson('GET',self::PETITION);
        $this->assertEquals(count($items),count(Empresa::all()));
    }
    public function testIndexEmpresaReturnSelf()
    {
        $this->seed();
        $user = $this->actingAsRol(self::EMPRESA_ROL);
        $item = $this->getDataFromJson('GET',self::PETITION)[0];
        $this->assertEquals($user->id,$item['id']);
    }
    public function testForbiddenForAlumno()
    {
        $this->seed();
        $this->actingAsRol(self::ALUMNO_ROL);
        $this->expectedForbidden('GET', self::PETITION);
    }
    public function testUnauthorizedFails()
    {
        $this->seed();
        $this->expectedUnauthenticated('GET', self::PETITION);
    }
}
