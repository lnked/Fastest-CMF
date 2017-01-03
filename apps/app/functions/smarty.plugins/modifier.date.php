<?php
/**
* Модификатор date: unix_timestamp, date, datetime => дата на человеческом языке
*
* param string $string
* param string $format — 'date', 'time', 'datetime'
* return string
*/
function smarty_modifier_date($string, $format='datetime')
{
   global $Language;

   if (!isset($Language['global'][$format.'_format'])) 
   {
      trigger_error('Modifier date: invalid format specified!');
      return '';
   }

   $format = $Language['global'][$format.'_format'];

   if (!is_numeric($string)) 
   {
      // Попытаемся прочтитать date и datetime
      $timestamp = strtotime($string);
      if ($timestamp!==FALSE && $timestamp!=-1 /*PHP<5.1*/) 
      {
         $string = $timestamp;
      }
   }

   // Это похоже на unix_timestamp?
   if (is_numeric($string)) 
   {
      // Месяц на человеческом языке
      $format = str_replace('%B', $Language['Month'][date('n', $string)], $format);   

      return strftime($format, $string);
   }

   // Мы ещё здесь? Что-то неладно...
   trigger_error('Invalid data for date modifier!');
   return '';
}