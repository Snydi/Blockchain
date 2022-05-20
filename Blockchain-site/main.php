<?php
error_reporting(E_ERROR | E_PARSE);
require_once 'header.php';
require_once 'Blockchain.php';
require_once 'Actions.php';
$obj = new Actions();
$chain = $obj->chain();

if(!isset($_GET['index'])) {
?>
    <div class="container-fluid " >
                                <h1 class="centered">Добавить транзакцию</h1>
        <form class="" name="transaction" method="post" action="main.php" enctype="multipart/form-data">

            <div class="row ">
                <div class="input-group col transactionfields">
                    <input type="text" required class="form-control" placeholder="Сумма" name="amount" maxlength="60"
                           value="">
                </div>

                <div class="input-group col">
                    <input type="text" required class="form-control" placeholder="Получатель" name="recipient" maxlength="60"
                           value="">
                </div>

                <div class="input-group col ">
                    <input type="text" required class="form-control" placeholder="Отправитель" name="sender" maxlength="60"
                           value="">
                </div>

                <div class="input-group col">
                        <button class="btn btn-primary"  formmethod="POST" type="submit"  name="submit">Отправить</button>
                </div>

            </div>

        </form>
    </div>

<div class="main py-5 container-fluid">
    <div class="container-fluid text-center mt-3  chain row " >
        <table class="table table-bordered" >
            <thead>
              <tr>
                  <th scope="col">Индекс</th>
                  <th scope="col">Хэш  блока</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $count = 0;
                  if(isset($chain)) {
                      foreach ($chain as $item) {
                          echo '<tr>';
                            if ($count === 0)
                            {
                                echo '<td>' . 1 . '</td>';
                            }
                            else
                            {
                                echo '<td>' . $item[0] . '</td>';
                            }
                                echo '<td>'.' <a href="?index='. $item[0]. '">'. $item[1] . '</td>'; //хеш  блока
                          echo '</tr>' . " ";
                          $count++;
                      }
                  }
                ?>
            </tr>
            </tbody>
        </table>
        <a class="btn btn-primary " type="button" id="button" href="?mine">Mine</a>
    </div>
<?php }
else if (isset($chain))
{
   //заготовка переменных
    $amount = 0;
    $index = $_GET['index'];
    $index--;
    foreach ($chain[$index] as $item)
    {
        $amount++;
    }
    ?>
                            <h1 class="centered"> Информация о блоке </h1>

    <div class="main py-5 container text-center" >
    <table class="table table-bordered" >
    <thead>
    <tr>
    </tr>
    </thead>
    <tbody>
        <?php
                echo ' <tr>';
                    echo ' <th scope="row">Хеш предыдущего блока</th>';
                        echo '<td>'.$chain[$index-1][1].'</td>';
                echo  '</tr>';

                echo ' <tr>';
                    echo ' <th scope="row">Proof</th>';
                        echo '<td>'.$chain[$index][2].'</td>';
                echo  '</tr>';

                echo ' <tr>';
                    echo ' <th scope="row">Дата</th>';
                        echo '<td>'.date('d/m/Y H:i:s',$chain[$index][3]).'</td>';
                echo  '</tr>';
        ?>
    </tbody>
    </table>
    </div>

                            <h1 class="centered"> Транзакции </h1>

    <div class="main py-5 container-fluid text-center">
        <table class="table table-bordered" >
            <thead>
            <tr>
                <th scope="col">Сумма</th>
                <th scope="col">Получатель</th>
                <th scope="col">Отправитель</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                    echo '<tr>';
                for ($i = 4; $i <$amount; $i++)
                {
                         echo '<td>'.$chain[$index][$i].'</td>'; //сумма
                         echo '<td>'.$chain[$index][$i+=1].'</td>'; //получатель
                         echo '<td>'. $chain[$index][$i+=1].'</td>'; //отправитель
                    echo '</tr>' . " ";

                    echo '<tr>' . " ";
                }
                ?>
            </tr>
            </tbody>
        </table>
        <a class="btn btn-primary w-25" type="button"  href="main.php">Вернуться</a>
    </div>
<?php }
include_once 'footer.php';
