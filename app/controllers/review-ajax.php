<?php
include "../settings/path.php";
include "../settings/db_functions.php";

if (isset($_POST['id_comment'])) {
	$id = $_POST['id_comment'];
	delete('auto_comments', $id);
	echo $id;
	exit();
}

if (isset($_POST['score_scope']) && isset($_POST['review_positiv_text']) && isset($_POST['review_negative_text'])) {
	global $pdo;
	$id = $_POST['id'];
	$id_auto = $_POST['id_auto'];
	$text_positive = trim($_POST['review_positiv_text']);
	$text_negative = trim($_POST['review_negative_text']);
	$score_scope = trim($_POST['score_scope']);
	$arrData = [
		'id_auto' => $id_auto,
		'id_user' => $id,
		'review_positiv_text' => $text_positive,
		'review_negative_text' => $text_negative,
		'score_scope' => $score_scope
	];
	$lastId = insert('auto_comments', $arrData);
	$comment = selectLastComment('auto_comments', 'users', (int)$lastId);
	$ht = htmlComment($comment);
	echo $ht;
	exit();
}


function htmlComment($comment)
{
	$user = selectOne('users', ['id' => $comment['id_user']]);
	if (!$user['admin']) {
		$html = <<<HTML
	   <div class="review-card" data-commentid="{$comment['id']}">
                                    <div class="review-card__block">
                                        <div class="review-card__item">
                                            <p>Пользователь</p>
                                            <span>{$comment['login']}</span>
                                        </div>
                                        <div class="review-card__item">
                                            <p>Оценка</p>
                                            <span>{$comment['score_scope']}</span>/ <span>5</span>
                                        </div>
                                    </div>
                                    <div class="review-card__item">
                                        <p>Достоинства</p>
                                        <div class="review-card__pole">
                                            <p>{$comment['review_positiv_text']}</p>
                                        </div>
                                    </div>
                                    <div class="review-card__item">
                                        <p>Недостатки</p>
                                        <div class="review-card__pole">
                                            <p>{$comment['review_negative_text']}</p>
                                        </div>

                                    </div>
                                </div>
HTML;
		return $html;
	}
	$html = <<<HTML
	   <div class="review-card" data-commentid="{$comment['id']}">
	     <div class="review-card__close js-review-close">X</div>
                                    <div class="review-card__block">
                                        <div class="review-card__item">
                                            <p>Пользователь</p>
                                            <span>{$comment['login']}</span>
                                        </div>
                                        <div class="review-card__item">
                                            <p>Оценка</p>
                                            <span>{$comment['score_scope']}</span>/ <span>5</span>
                                        </div>
                                    </div>
                                    <div class="review-card__item">
                                        <p>Достоинства</p>
                                        <div class="review-card__pole">
                                            <p>{$comment['review_positiv_text']}</p>
                                        </div>
                                    </div>
                                    <div class="review-card__item">
                                        <p>Недостатки</p>
                                        <div class="review-card__pole">
                                            <p>{$comment['review_negative_text']}</p>
                                        </div>

                                    </div>
                                </div>
HTML;
	return $html;


}