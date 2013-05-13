<?php
function pagination($per_page = 10, $page = 1, $url = '', $total){

	$adjacents = "2";

	$page = ($page == 0 ? 1 : $page);
	$start = ($page - 1) * $per_page;

	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total/$per_page);
	$lpm1 = $lastpage - 1;

	$pagination = "<div class='pagination-wrapper'>";
	if($lastpage > 1){
		$pagination .= "<ul class='pagination details'>";
		$pagination .= "<li class='details'>Page $page sur $lastpage</li></ul>";
		$pagination .= "<ul class='pagination pages'>";
		if ($lastpage < 7 + ($adjacents * 2))		{
			for ($counter = 1; $counter <= $lastpage; $counter++)	{
				if ($counter == $page)
					$pagination.= "<li><a class='current'>$counter</a></li>";
				else
					$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";
			}
		}elseif($lastpage > 5 + ($adjacents * 2)){
			if($page < 1 + ($adjacents * 2)){
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)	{
					if ($counter == $page)
						$pagination.= "<li><a class='current'>$counter</a></li>";
					else
						$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";
				}
				$pagination.= "<li class='dot'>...</li>";
				$pagination.= "<li><a href='{$url}$lastpage'>$lastpage</a></li>";
			}else{
// 				$pagination.= "<li><a href='{$url}1'>Debut</a></li>";
				if($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){
					$pagination.= "<li><a href='{$url}1'>1</a></li>";
					$pagination.= "<li class='dot'>...</li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){
						if ($counter == $page)
							$pagination.= "<li><a class='current'>$counter</a></li>";
						else
							$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";
					}
					$pagination.= "<li class='dot'>...</li>";
					$pagination.= "<li><a href='{$url}$lastpage'>$lastpage</a></li>";
				}else{
					$pagination.= "<li><a href='{$url}1'>1</a></li>";
					$pagination.= "<li class='dot'>...</li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){
						if ($counter == $page)
							$pagination.= "<li><a class='current'>$counter</a></li>";
						else
							$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";
					}
				}
			}
		}

		if ($page < $counter - 1){
			$pagination.= "<li><a href='{$url}$next'>Suivant</a></li>";
		}else{
			$pagination.= "<li><a class='disabled'>Suivant</a></li>";
		}
		$pagination.= "</ul>";
	}
	$pagination.="</div>\n";
	return $pagination;
}
?>