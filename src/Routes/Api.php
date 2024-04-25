<?php
use App\Core\Http\Route;

Route::group(function () {
    Route::middleware("AuthMiddleware");
    //Rotas privadas
});
Route::get("/user", "Usuarios/UsuariosController::getJson");
Route::post("/user", "Usuarios/UsuariosController::Create");