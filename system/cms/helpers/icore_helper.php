<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Imaginamos SAS
 *
 * Helper construido por el Núcleo Tecnológico y colaboradores
 *
 * @package   PyroCMS\Core\Helpers
 * @author    Brayan Acebo
 * @copyright Copyright (c) 2014
 */

if (!function_exists('slug'))
{

	/**
	 * Creando Slug para url`s limpias/amigables
	 *
	 * @param string  $string  The string
	 *
	 * @return string The slug
	 */
	function slug($string) {
		$characters = array(
			"Á" => "A", "Ç" => "c", "É" => "e", "Í" => "i", "Ñ" => "n", "Ó" => "o", "Ú" => "u",
			"á" => "a", "ç" => "c", "é" => "e", "í" => "i", "ñ" => "n", "ó" => "o", "ú" => "u",
			"à" => "a", "è" => "e", "ì" => "i", "ò" => "o", "ù" => "u"
			);
		$string = strtr($string, $characters);
		$string = strtolower(trim($string));
		$string = preg_replace("/[^a-z0-9-]/", "-", $string);
		$string = preg_replace("/-+/", "-", $string);
		if(substr($string, strlen($string) - 1, strlen($string)) === "-") {
			$string = substr($string, 0, strlen($string) - 1);
		}
		return $string;
	}

}

if (!function_exists('val_image'))
{

	/**
	 * Se valdia si existe la imagen y si no pone una por defecto
	 *
	 * @param string  $string  Url de la imagen/path
	 *
	 * @return string La imagen
	 */
	function val_image($image) {
		return ($image) ? site_url($image) : site_url('uploads/default/no-disponible.jpg');
	}
}


if (!function_exists('timespan')) {

    function timespan($seconds = 1, $time = '') {
        $CI = & get_instance();
        $CI->lang->load('date');

        if (!is_numeric($seconds)) {
            $seconds = strtotime($seconds);
        }

        if (!is_numeric($time)) {
            $time = time();
        }

        if ($time <= $seconds) {
            $seconds = 1;
        } else {
            $_time = $seconds;
            $seconds = $time - $seconds;
        }


        $days = floor($seconds / 86400);

        if ($days <= 0) {
            $str = 'Hace ';
            $hours = floor($seconds / 3600);
            $minutes = floor($seconds / 60);
            if ($hours > 0) {
                $str .= $hours . ' ' . $CI->lang->line((($hours > 1) ? 'date_hours' : 'date_hour')) . ', ';
            } elseif ($minutes > 0) {
                $str .= $minutes . ' ' . $CI->lang->line((($minutes > 1) ? 'date_minutes' : 'date_minute')) . ', ';
            } else {
                $str .= 'unos instantes,';
            }

            $str = substr(trim($str), 0, -1);
        } else {
            setlocale(LC_TIME, 'spanish');
            $dia = date("j", $_time);
            $mes = ucfirst(strftime('%B', $_time));
            $str = $dia . ' de ' . $mes;
            $years = floor($seconds / 31536000);

            if ($years > 0) {
                $year = date("Y", $_time);
                $str .= ', ' . $year;
            }
        }

        return $str;
    }

}

if (!function_exists('timespan_native')) {

    function timespan_native($seconds = 1, $time = '') {
        $CI = & get_instance();
        $CI->lang->load('date');

        if (!is_numeric($seconds)) {
            $seconds = 1;
        }

        if (!is_numeric($time)) {
            $time = time();
        }

        if ($time <= $seconds) {
            $seconds = 1;
        } else {
            $seconds = $time - $seconds;
        }

        $str = '';
        $years = floor($seconds / 31536000);

        if ($years > 0) {
            $str .= $years . ' ' . $CI->lang->line((($years > 1) ? 'date_years' : 'date_year')) . ', ';
        }

        $seconds -= $years * 31536000;
        $months = floor($seconds / 2628000);

        if ($years > 0 OR $months > 0) {
            if ($months > 0) {
                $str .= $months . ' ' . $CI->lang->line((($months > 1) ? 'date_months' : 'date_month')) . ', ';
            }

            $seconds -= $months * 2628000;
        }

        $weeks = floor($seconds / 604800);

        if ($years > 0 OR $months > 0 OR $weeks > 0) {
            if ($weeks > 0) {
                $str .= $weeks . ' ' . $CI->lang->line((($weeks > 1) ? 'date_weeks' : 'date_week')) . ', ';
            }

            $seconds -= $weeks * 604800;
        }

        $days = floor($seconds / 86400);

        if ($months > 0 OR $weeks > 0 OR $days > 0) {
            if ($days > 0) {
                $str .= $days . ' ' . $CI->lang->line((($days > 1) ? 'date_days' : 'date_day')) . ', ';
            }

            $seconds -= $days * 86400;
        }

        $hours = floor($seconds / 3600);

        if ($days > 0 OR $hours > 0) {
            if ($hours > 0) {
                $str .= $hours . ' ' . $CI->lang->line((($hours > 1) ? 'date_hours' : 'date_hour')) . ', ';
            }

            $seconds -= $hours * 3600;
        }

        $minutes = floor($seconds / 60);

        if ($days > 0 OR $hours > 0 OR $minutes > 0) {
            if ($minutes > 0) {
                $str .= $minutes . ' ' . $CI->lang->line((($minutes > 1) ? 'date_minutes' : 'date_minute')) . ', ';
            }

            $seconds -= $minutes * 60;
        }

        if ($str == '') {
            $str .= $seconds . ' ' . $CI->lang->line((($seconds > 1) ? 'date_seconds' : 'date_second')) . ', ';
        }

        return substr(trim($str), 0, -1);
    }

}


if (!function_exists("fecha_spanish")) {

    function fecha_spanish($string_date) {
        if (is_numeric($string_date)) {
            $string_date = date(DATE_MYSQL, $string_date);
        }
        $fecha = date_create($string_date);
        $meses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $meses_short = array('', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Novi', 'Dic');
        $dias = array('', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
        $dias_short = array('', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom');



        return array(
            'dia' => date_format($fecha, 'd'),
            'dia_text' => $dias[date_format($fecha, 'N')],
            'dia_text_short' => $dias_short[date_format($fecha, 'N')],
            'mes' => $meses[date_format($fecha, 'n')],
            'mes_short' => $meses_short[date_format($fecha, 'n')],
            'ano' => date_format($fecha, 'Y'),
            'hora' => date_format($fecha, 'h:i A'),
            );
    }

}

if (!function_exists("fecha_calendario")) {

    function fecha_calendario($string_date) {
        $fecha = fecha_spanish($string_date);

        return $fecha['mes'] . ' ' . $fecha['dia'] . ', ' . $fecha['ano'];
    }

}

if (!function_exists("fecha_spanish_full")) {

    function fecha_spanish_full($string_date, $hour = FALSE, $dia_text = TRUE, $short_month = FALSE) {
        $fecha = fecha_spanish($string_date);
        $return = NULL;

        if ($dia_text) {
            $return = $fecha['dia_text'] . ', ';
        }

        $mes = $fecha['mes'];
        if (TRUE === $short_month) {
            $mes = character_limiter($mes, 3, '');
        }

        $return .= $fecha['dia'] . ' de ' . $mes . ' de ' . $fecha['ano'];

        if (!$hour)
            return $return;

        return $return . ', ' . $fecha['hora'];
    }

}

if (!function_exists("fecha_spanish_full_hour")) {

    function fecha_spanish_full_hour($string_date) {
        return fecha_spanish_full($string_date, true);
    }

}

if (!function_exists("fecha_spanish_full_short")) {

    function fecha_spanish_full_short($string_date, $hour = FALSE) {
        $fecha = fecha_spanish($string_date);
        $return = NULL;

        $return = $fecha['dia'] . ' ' . $fecha['mes_short'] . ', ' . $fecha['ano'];

        if (!$hour)
            return $return;

        return $return . '. ' . $fecha['hora'];
    }

}

if (!function_exists("fecha_comentario")) {

    function fecha_comentario($string_date) {
        $fecha = fecha_spanish($string_date);

        $return = $fecha['dia_text'] . ', ' . $fecha['dia'] . ' de ' . $fecha['mes'] . ' de ' . $fecha['ano'];

        if (!$return)
            return $return;

        return $return . ', ' . $fecha['hora'];
    }

}


if (!function_exists("datetime_now")) {

    function datetime_now() {
        $fecha = new DateTime('now');
        return $fecha->format(DATE_MYSQL);
    }

}

if (!function_exists("strtodate")) {

    function strtodate($date) {
        if (!empty($date)) {
            $fecha = new DateTime($date);
            return $fecha->format('Y-m-d');
        }
        return NULL;
    }

}

// -----------------------------------------------------------------------------

if (!function_exists("strtodate_slash")) {

    function strtodate_slash($date) {
        if (!empty($date)) {
            list($day, $month, $year) = sscanf($date, '%02d/%02d/%04d');
            return strtodate("$year-$month-$day");
        }
        return NULL;
    }

}


if (!function_exists("treemenu")) {

    /**
     * Esta función permite crear un menú en arbol
     *
     * @param object  $rows  Es el objecto de categorias a transformar en el menú
     * @param int  $parent  Id del padre al que pertenece
     * @return string Un div con el menú formado en ul y li
     */

    function treemenu($rows,$module=null,$parent=0,$ban=true) {
        $result = "<ul>";
        if($ban) $result.= "<li id='todos'><a href='{$module}'>Todos</a></li>";
        foreach ($rows as $row) {
            if ($row->parent == $parent) {
                $result.= "<li id='".$row->slug."'><a href='{$module}/index/".$row->slug."'>".$row->title."</a>";
                foreach ($rows as $subrow) {
                    if ($subrow->parent == $row->id)
                     $children = true;
                 else $children = false;
             }
             if ($children = true)
                $result.= treemenu($rows,$module,$row->id,false) . "</li>";
        }
    }
    $result .= "</ul>";
    return $result;
    }
}
