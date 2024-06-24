<?php 
session_start();
require_once('conn.php');
$data = new Database();
if (isset($_SESSION['username'])) :
   if ($data->checkRole($_SESSION['username'])) : 
?>
    <table class="table table-striped table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Marka</th>
          <th scope="col">Model</th>
          <th scope="col">Rok</th>
          <th scope="col">Nadwozie</th>
          <th scope="col">Kolor</th>
          <th scope="col">Moc</th>
          <th scope="col">Edytuj</th>
          <th scope="col">Usuń</th>
          <th scope="col">
           <?php
            if (isset($_SESSION['admin']) || isset($_SESSION['editor'])) : ?>
              <button class="btn btn-outline-success" id="addBtn">Dodaj Auto</button>
          </th>
        <?php endif; ?>
        
          <th><?php 
              if (isset($_SESSION['username'])) { ?>
              <span class="login">Witaj, <?=$_SESSION['username']?>! </span>
          </th>
          <th><a href="./logout.php"><button class="btn btn-outline-success">Wyloguj</button></a></th>
        <?php 
              } else {
                header('Location: index.php');
              }
        ?>

        </th>

          </tr>
      </thead>
      <tbody>
        <?php
          require_once ('connect.php');
          $sql = 'SELECT * FROM cars_table';
          $result = mysqli_query($conn, $sql);
          $count = 1;
            if(mysqli_num_rows($result)>0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
        ?>
          <tr>
            <td><?= $count?></td>
            <td><?= $row['brand']?></td>
            <td><?= $row['model']?></td>
            <td><?= $row['vintage']?></td>
            <td><?= $row['type']?></td>
            <td><?= $row['color']?></td>
            <td><?= $row['hp']?></td>
            <td>
              <?php if (isset($_SESSION['admin']) || isset($_SESSION['editor'])) : ?>
                <button data-id="<?=$row['id'] ?>" id="edit" class="edit"><span class="material-icons">create</span></button>
                <?php endif; ?>
            </td>
            <td colspan="2">
              <?php if (isset($_SESSION['admin'])) : ?>
                <button data-id="<?=$row['id'] ?>" id="delete" class="delete"><span class="material-icons">delete</span></button>
                <?php endif; ?>
            </td>
          </tr>
          <?php 
            $count++;
                }
            } else {
          ?>
          <td class="text-center" colspan="9"><?= "Brak danych w bazie" ?></td>
          <?php }
            mysqli_close($conn);
          ?>
      </tbody>
    </table>
    <?php endif; ?>
    <?php else : 
    header("Location: login_form.php");
    endif;
    ?>  
