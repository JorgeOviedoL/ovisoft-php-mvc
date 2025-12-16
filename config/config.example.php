<?php

/**
 * Archivo de Configuración de Ejemplo
 * 
 * Copia este archivo como config.php y ajusta los valores según tu entorno.
 * Este archivo muestra todas las constantes disponibles con valores de ejemplo.
 * 
 * @package OviSoft
 * @version 1.2.0
 */

/*==============================================================
 = URL Base de la Aplicación
 = Define la URL raíz desde donde se accede a la aplicación
==============================================================*/
const BASE_URL = "http://localhost/";

/*==============================================================
 = Configuración de Zona Horaria
 = Define la zona horaria para funciones de fecha/hora de PHP
 = Debe coincidir con DB_TIMEZONE para consistencia
==============================================================*/
date_default_timezone_set('America/Mexico_City');

/*==============================================================
 = Configuración de Base de Datos
 = Credenciales y parámetros de conexión a MySQL
 = Descomenta y ajusta según tus necesidades
==============================================================*/
/*
const DB_HOST = "localhost";
const DB_NAME = "database";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_CHARSET = "utf8mb4";
const DB_TIMEZONE = "-06:00";  // Zona horaria de MySQL (formato UTC offset)
*/

/*==============================================================
 = Configuración de Formato de Moneda
 = Define los separadores y símbolo para formateo de números
==============================================================*/

/** @var string Separador Decimal */
const SPD = ".";

/** @var string Separador de Millares */
const SPM = ",";

/** @var string Símbolo de Moneda */
const SMONEY = "$";

/*==============================================================
 = Configuración de Errores
 = En producción, cambiar error_reporting a 0 y display_errors a '0'
==============================================================*/
error_reporting(E_ALL);
ini_set('display_errors', '1');
