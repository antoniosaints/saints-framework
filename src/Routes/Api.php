<?php

use App\Http\Route;

Route::get("/", "Usuarios/UsuariosController::getJson");

// Rotas usuarios
Route::post("/users", "Usuarios/UsuariosController::Create");