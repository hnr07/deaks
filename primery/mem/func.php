<?php
/**
 * Получая картинку $IshodnoeImage формирует миниатюру $ItogovoeImage
 * с заданнами максимальными шириной $maxShirina и высотой $maxVisota.
 * 
 * @param string $IshodnoeImage
 * @param string $ItogovoeImage
 * @param int $maxShirina
 * @param int $maxVisota
 * @return boolean
 */
function sozdatMiniaturu($IshodnoeImage, $ItogovoeImage, $maxShirina, $maxVisota) {
    // Вытягиваем информацию о полученной картинке:
    $VsyaInfaOKartinke = getImageSize($IshodnoeImage);
 
    // Картинка какого типа нам попалась:
    switch ($VsyaInfaOKartinke[2]) :
        // Типы картинок PNG, GIF, JPEG:
        case IMAGETYPE_PNG:
            $TipIzobrageinya = 'png';
            break;
 
        case IMAGETYPE_GIF:
            $TipIzobrageinya = 'gif';
            break;
            
        case IMAGETYPE_JPEG:
            $TipIzobrageinya = 'jpeg';
            break;
            
        // Неизвестный тип файла, прерываемся:    
        default: 
            return false;
            break;
    endswitch;
 
    if (!function_exists('imagecreatefrom' . $TipIzobrageinya)) :
        return false;
    endif;
 
    // Исходная картинка:
    $imgSrc = call_user_func('imagecreatefrom' . $TipIzobrageinya, $IshodnoeImage);
 
    // Теперь $ishodnyaShirina и $ishodnyaVisota станут шириной и высотой исходного Image:
    list($ishodnyaShirina, $ishodnyaVisota) = $VsyaInfaOKartinke;
 
    // Высчитываем пропорции изображения:
    if (($ishodnyaShirina > $maxShirina) || ($ishodnyaVisota > $maxVisota)) :
        if ($ishodnyaShirina > $ishodnyaVisota) :
            $proporcia = $maxShirina / $ishodnyaShirina;
        else :
            $proporcia = $maxVisota / $ishodnyaVisota;
        endif;
    else :
        $proporcia = 1;
    endif;
 
    $novayaShirina = round($ishodnyaShirina * $proporcia); // Ширина копии
    $novayaVisota = round($ishodnyaVisota * $proporcia); // Высота копии
 
    // Генерируем уменьшенную копию картинки:
    $umenshennoeIzobragenie = imagecreatetruecolor($novayaShirina, $novayaVisota);
    // Пропорционально меняем размер со сглаживанием:
    ImageCopyResampled($umenshennoeIzobragenie, $imgSrc, 0, 0, 0, 0, $novayaShirina, $novayaVisota, $ishodnyaShirina, $ishodnyaVisota);
    // Сохраняем в $ItogovoeImage
    call_user_func_array('image' . $TipIzobrageinya, array($umenshennoeIzobragenie, $ItogovoeImage));
 
    return true;
}