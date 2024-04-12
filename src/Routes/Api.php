<?php

// Rotas usuarios

use App\Core\Http\Route;

Route::get("/user", "Usuarios/UsuariosController::getJson");
Route::post("/user", "Usuarios/UsuariosController::Create");