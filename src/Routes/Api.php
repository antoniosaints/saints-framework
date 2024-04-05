<?php

use App\Http\Route;

Route::post("/", "ExampleController::getJson");

// Rotas usuarios
Route::post("/users", "Usuarios\\UsuariosController::Create");