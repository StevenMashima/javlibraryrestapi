<?php
include "simple_html_dom.php";
// $page = 1;
// if(isset($_GET['page'])){
//     $page = $_GET['page'];
// }
// $promoted = 10;
// $html = file_get_html('https://xhamster.com/new/'.$page.'.html');
// if($page > 1){
//     $promoted = 6;
// }
// $i = 0;
// $output = array();
// foreach ($html->find('div[class=video]') as $data){
//     if($i <$promoted){
//     $output['promoted'][$i]['title'] = $data->find('a',0)->children(0)->alt;
//     $output['promoted'][$i]['thumb'] = $data->find('a',0)->children(0)->src;
//     $output['promoted'][$i]['minutes'] = $data->find('a',0)->children(2)->innertext;
//     $output['promoted'][$i]['views'] = $data->last_child()->children(1)->innertext;
//     $output['promoted'][$i]['rate'] = $data->last_child()->children(0)->innertext;
//     $output['promoted'][$i]['link'] = $data->find('a',0)->href;
//     $hd=false;
//         if($data->find('a',0)->children(4)!= null){
//             $hd = true;
//         }
//     $output['promoted'][$i]['hd'] = $hd;
//     $i++;
//     }else {
//             $output['new'][$i]['title'] = $data->find('a',0)->children(0)->alt;
//             $output['new'][$i]['thumb'] = $data->find('a',0)->children(0)->src;
//             $output['new'][$i]['minutes'] = $data->find('a',0)->children(2)->innertext;
//             $output['new'][$i]['views'] = $data->last_child()->children(1)->innertext;
//             $output['new'][$i]['rate'] = $data->last_child()->children(0)->innertext;
//             $output['new'][$i]['link'] = $data->find('a',0)->href;
//             $hd=false;
//             if($data->find('a',0)->children(4)!= null){
//                 $hd = true;
//             }
//             $output['new'][$i]['hd'] = $hd;
//             $i++;
//     }
// }
// $output['count'] = $i;
// echo '<pre style="word-wrap: break-word; white-space: pre-wrap;">';
// echo json_encode($output);
// echo '</pre>';

$html = file_get_html($_GET['url']);
$output = array();
$output['title'] = $html->find('div[id=video_title]')[0]->children(0)->children(0)->innertext;
$output['id'] = $html->find('div[id=video_id]')[0]->children(0)->children(0)->children(1)->innertext;
$output['poster'] = $html->find('img[id=video_jacket_img]')[0]->src;
$output['release_date'] = $html->find('div[id=video_date]')[0]->children(0)->children(0)->children(1)->innertext;
$output['length'] = $html->find('div[id=video_length]')[0]->children(0)->children(0)->children(1)->find('span',0)->innertext;
$output['maker'] = $html->find('div[id=video_maker]')[0]->children(0)->children(0)->children(1)->children(0)->children(0)->innertext;
$i = 0;
foreach($html->find('div[id=video_genres]')[0]->children(0)->children(0)->children(1)->find('span') as $data){
  $output['genre'][$i] = $data->children(0)->innertext;
  $i++;
}
$i = 0;
foreach($html->find('div[id=video_cast]')[0]->children(0)->children(0)->children(1)->find('span[class=cast]') as $data){
  $output['cast'][$i] = $data->children(0)->children(0)->innertext;
  $i++;
}
echo json_encode($output);
