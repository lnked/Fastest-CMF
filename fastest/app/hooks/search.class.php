<?php

final class Search
{
    public function __construct()
    {

    }
}

// $var_1 = 'PHP IS GREAT'; 
// $var_2 = 'WITH MYSQL'; 

// similar_text($var_1, $var_2, $percent); 

// __($percent, "<br>");
// // 27.272727272727 

// similar_text($var_2, $var_1, $percent); 

// echo $percent, "<br>";
// // 18.181818181818 

// // введенное слово с опечаткой
// $input = 'carrrot';

// // массив сверяемых слов
// $words  = array('apple','pineapple','banana','orange',
//                 'radish','carrot','pea','bean','potato');

// // кратчайшее расстояние пока еще не найдено
// $shortest = -1;

// // проходим по словам для нахождения самого близкого варианта
// foreach ($words as $word) {

//     // вычисляем расстояние между входным словом и текущим
//     $lev = levenshtein($input, $word);

//     // проверяем полное совпадение
//     if ($lev == 0) {

//         // это ближайшее слово (точное совпадение)
//         $closest = $word;
//         $shortest = 0;

//         // выходим из цикла - мы нашли точное совпадение
//         break;
//     }

//     // если это расстояние меньше следующего наименьшего расстояния
//     // ИЛИ если следующее самое короткое слово еще не было найдено
//     if ($lev <= $shortest || $shortest < 0) {
//         // set the closest match, and shortest distance
//         $closest  = $word;
//         $shortest = $lev;
//     }
// }

// if ($shortest == 0) {
//     __("Найдено точное совпадение: ", $closest);
// } else {
//     __("Вы не имели в виду:", $closest);
// }

// __("Вы ввели:", $input);