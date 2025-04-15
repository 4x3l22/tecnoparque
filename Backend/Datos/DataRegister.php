<?php

namespace Datos;

class DataRegister
{
    private string $name;
    private string $email;
    private string $password;
    private string $rol;

    //Getters
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getRol(){
        return $this->rol;
    }

    //Setters
    public function setName(string $name){
        $this->name = $name;
    }
    public function setEmail(string $email){
        $this->email = $email;
    }
    public function setPassword(string $password){
        $this->password = $password;
    }
    public function setRol(string $rol){
        $this->rol = $rol;
    }
}