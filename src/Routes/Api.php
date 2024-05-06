<?php
use App\Core\Http\Route;


Route::group(function () { // grupo de rotas privadas
    Route::middleware("AuthMiddleware"); 
    // Rotas abaixo do middleware
});

Route::group(function () { // grupo de rotas publicas
    Route::get("/user", "Usuarios/UsuariosController::getJson");
    Route::post("/user", "Usuarios/UsuariosController::Create");
});