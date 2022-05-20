<?php
class Actions extends Blockchain //тут происходит прием и обработка запросов с сервера
{
    public static function chain()
    {
        $obj = new Blockchain();

        if (isset($_GET['mine']) )
        {
            $obj->mine();
            header('Location: main.php');
        }
        if (isset($_POST['submit']) )
        {
            $data = array('sender'=>$_POST['sender'], 'recipient'=>$_POST['recipient'], 'amount'=>$_POST['amount']);
            $data = json_encode($data);
            $obj->addTransaction($data);

        }
        $showchain = $obj->showChain();
        if(isset($showchain)) {
            foreach ($showchain as $item ) {
                $item =str_replace('}','',$item);
                $item =str_replace('{','',$item);
                $item =str_replace('"','',$item);
                $item =str_replace('\\','',$item);
                $item =str_replace('[','',$item);
                $item =str_replace(':',',',$item);
                $item =str_replace('chain','',$item);
                $item =str_replace(']]','',$item);
                $item =str_replace('index,','',$item);
                $item =str_replace('proof,','',$item);
                $item =str_replace('timestamp,','',$item);
                $item =str_replace('transactions,','',$item);
                $item =str_replace('previous_hash,','',$item);
                $item =str_replace('recipient,','',$item);
                $item =str_replace('sender,','',$item);
                $item =str_replace('amount,','',$item);
                $data = explode(",", $item);
                $chain[] = $data;
            }
        }
        return $chain;
    }




}