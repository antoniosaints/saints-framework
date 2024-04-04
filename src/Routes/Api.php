<?php

use App\Http\Route;

Route::post("/", "ExampleController::getJson");

// Rotas usuarios
Route::get("/users", "Usuarios/UsuariosController::Index");