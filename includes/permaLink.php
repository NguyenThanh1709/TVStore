<?php
function getPremaLink($module)
{
  $perFixArr = [
    'services' => 'dich-vu',
    'pages' => 'trang',
    'portfolios' => 'du-an',
    'blogs' => 'bai-viet'
  ];

  if (!empty($perFixArr)) {
    return $perFixArr[$module];
  }
}
