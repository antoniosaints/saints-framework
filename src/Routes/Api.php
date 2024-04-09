<?php

use App\Http\Route;


// Rotas usuarios
Route::get("/user", "Usuarios/UsuariosController::getJson");
Route::post("/user", "Usuarios/UsuariosController::Create");