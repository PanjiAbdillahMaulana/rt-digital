<?php
//require_once __DIR_ "/vendor/autoload.php"; 
ini_set('allow_url_fopen',1);
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/': 
        require 'index.php'; 
        break;
    case '/index':
        require 'index.php'; 
        break;
    case '/index.php':
        require 'index.php';
        break;
    case '/aktivasi.php':
            require 'aktivasi.php';
            break;
    case '/cetak-SKTM.php':
            require 'cetak-SKTM.php';
            break;
    case '/cetak-surat-domisili.php':
            require 'cetak-surat-domisili.php';
            break;
    case '/dashboard.php':
            require 'dashboard.php';
            break;
    case '/dashboard-admin.php':
            require 'dashboard-admin.php';
            break;
    case '/keluarkan-surat.php':
            require 'keluarkan-surat.php';
            break;
    case '/konfirmasi-akun.php':
            require 'konfirmasi-akun.php';
            break;
    case '/login.php':
            require 'login.php';
            break;
    case '/permintaan-SKTM.php':
            require 'permintaan-SKTM.php';
            break;
    case '/preview-SKTM.php':
            require 'preview-SKTM.php';
            break;
    case '/preview-surat-domisili.php':
            require 'preview-surat-domisili.php';
            break;
    case '/register.php':
            require 'register.php';
            break;
    case '/riwayat-surat.php':
            require 'riwayat-surat.php';
            break;
    case '/tidak-keluarkan-surat.php':
            require 'tidak-keluarkan-surat.php';
            break;
    case '/tidak-konfirmasi-akun.php':
            require 'tidak-konfirmasi-akun.php';
            break;
    case '/function/function.php': 
        require __DIR__.'/function/function.php';
        break;
    case '/function/logout.php':
        require __DIR__.'/function/logout.php';
        break;
    default:
        http_response_code(404);
        echo @parse_url($_SERVER['REQUEST_URI'])['path']; 
        exit('Not Found');
    }
?>