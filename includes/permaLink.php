<?php
function getLinkModule($module, $slug)
{
  $perFixUrl = getPremaLink($module);
  $link = _WEB_HOST_ROOT . '/' . $perFixUrl . '/' . $slug . '.html';
  return $link;
}

function getPremaLink($module)
{
  $perFixArr = [
    'services' => 'dich-vu',
    'pages' => 'trang',
    'portfolios' => 'du-an',
    'blogs' => 'bai-viet',
    'blog_categories' => 'bai-viet/danh-muc'
  ];

  if (!empty($perFixArr)) {
    return $perFixArr[$module];
  }
}
