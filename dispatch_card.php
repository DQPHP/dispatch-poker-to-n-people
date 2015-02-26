<?php

/*
 * トランプをn人に配る
 */
class play_card {
    
    /*
     * トランプを人に配る
     */
    public function dispatch_card($n = null){
        /* 入力内容不正処理 0、数字ではない、マイナス数字　*/
        if (!$n || !is_int($n) || $n < 0) {
            echo '入力値が無いか、値が不正です。';
            exit();
        }
        /* トランプカードをランダムする */
        $card_arr = $this->shuffle_card( $this->create_card() );
        /* カード枚数 */
        $count = count($card_arr);
        /* 一人に最大カード枚数 = カード枚数 / 人数 */
        $times = $count / $n;
        
        for($i = 0; $i < $n; $i++){
            
            for($t = 0; $t < $times; $t++){
                /* 該当配布カード回数 */
                $current  = $i + $t * $n;
                /* 該当配布カード回数はカード枚数より大きいすれば、配布停止 */
                if($current < $count){
                    $dispatch_card[] = $card_arr[$current];
                }else{
                    break;
                }
            }
            /* 該当人にカードを出力する */
            echo implode(',', $dispatch_card);
            echo '\n';
            unset($dispatch_card);
        }
    }
    
    /*
     * トランプカードを生成する
     * 0-12スペード-S　A,2,3,...9,X,J,Q,K
     * 13-25ハート-H A,2,3,...9,X,J,Q,K
     * 26-38ダイア-D A,2,3,...9,X,J,Q,K
     * 38-51クラブ-C A,2,3,...9,X,J,Q,K
     */
    protected function create_card(){
        $card_arr = array();
        /* カード種類 */
        $TYPE = array('0' => 'S', '1' => 'H', '2' => 'D', '3' => 'C');
        /* カード名 */
        $VALUE = array('0' => 'A', '9' => 'X', '10' => 'J', '11' => 'Q', '12' => 'K');
        /* 52枚のカードを生成する */
        for($i = 0; $i < 52; $i ++){
            $type = $TYPE[$i / 13];     // カード種類
            $value = $i % 13;           // カード名
            switch($value){
                case 0:
                    $value = $VALUE[$value];
                    break;
                case 9:
                    $value = $VALUE[$value];
                    break;
                case 10:
                    $value = $VALUE[$value];
                    break;
                case 11:
                    $value = $VALUE[$value];
                    break;
                case 12:
                    $value = $VALUE[$value];
                    break;
                default:
                    $value = $value + 1 ;
                    break;
            }
            $card_arr[$i] = $type.'-'.$value;
        }
        return $card_arr;
    }
    
    /*
     * カードをランダム
     */
    protected function shuffle_card($card_arr){
        $count = count($card_arr);
        for($i = 0; $i < $count; $i ++){
            $rnd = rand() % $count;
            /* ランダム数字のカードと該当カードを交換 */
            $temp = $card_arr[$i];
            $card_arr[$i] = $card_arr[$rnd];
            $card_arr[$rnd] = $temp;
        }
        return $card_arr;
    }
}

/*
 * テスト
 */
$play_card = new play_card;
$play_card->dispatch_card(5);

/*****************************************\
 ******************結果********************
S-3,H-J,C-Q,D-6,D-4,D-Q,D-J,D-9,C-5,S-4,S-6
D-7,C-6,C-9,S-A,S-2,D-8,H-X,H-Q,H-6,D-K,H-3
D-5,D-2,C-8,C-J,C-A,S-5,H-K,D-X,H-2,S-9
H-7,H-9,D-3,C-K,H-4,H-A,S-Q,D-A,S-J,H-8
S-8,S-7,C-7,H-5,C-X,C-3,C-4,S-K,C-2,S-X
/*****************************************/
