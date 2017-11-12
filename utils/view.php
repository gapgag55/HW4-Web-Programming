<?php 

function view($path, $data = []) {
  require "views/{$path}.php";
}