<!DOCTYPE html>
<html lang="en">

    <head>

        <title>Leons Bookmarks</title>
        <link rel="stylesheet" href="style.css">

        <script>
            function confirmDelete(id, url) {
                var choice = confirm("Really delete Link\n" + url + "\n?")
                if(choice == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>

    </head>

    <body>

        <!-- Initialisation -->
        <?php 
            include "connection.php";
            $conn = openConnection();
            $categories = $conn->query("SELECT * FROM Category");
        ?>

        <h1>Leons Bookmarks</h1>

        <!-- All Categories -->
        <div class="box" id="categories">
            <h2>All Categories</h2>
            <div id="categoryLinkContainer">
                <?php
                    for($i = 0; $i < $categories->num_rows; $i++) {
                        $categories->data_seek($i);
                        $row1 = $categories->fetch_assoc();
                        echo "<a class=\"categoryLink\" href=\"#".$row1['name']."\">#".$row1['name']."</a>";
                    }
                ?>
            </div>
        </div>

        <!-- Adder Field -->
        <div class="box" id="adder">
            <h2>Add Bookmark</h2>
            <div id="adderFormContainer">
                <form method="post" action="action.php">

                    <input type="text" name="url" placeholder="URL">

                    <select name="category">
                        <?php
                            for($i = 0; $i < $categories->num_rows; $i++) {
                                $categories->data_seek($i);
                                $row1 = $categories->fetch_assoc();
                                echo "<option value=\"".$row1['id']."\">".$row1['name']."</option>";
                            }
                        ?>
                    </select>

                    <label>Fav:</label>
                    <input type="checkbox" name="fav" value="yes">

                    <br>
                    <br>

                    <input type="submit" value="Save Bookmark">

                </form>
            </div>
        </div>

        <!-- Bookmark List -->
        <div class="box" id="list">
            <div id="listContainer">
                <?php
                    for($i = 0; $i < $categories->num_rows; $i++) {
                        $categories->data_seek($i);
                        $row1 = $categories->fetch_assoc();
                        echo "<h3 id=\"".$row1['name']."\">".$row1['name']."</h3>";      // printing category name and id, to jump to

                        echo "<ul>";
                        $links = $conn->query("SELECT * FROM Link WHERE category=".$row1['id']);
                        for($j = 0; $j < $links->num_rows; $j++) {
                            $links->data_seek($j);
                            $row2 = $links->fetch_assoc();
                            echo "<li><form method='post' action='action.php' onsubmit=\"return confirmDelete(".$row2['id'].",'".$row2['url']."');\">";
                            echo "<button class='delButton' type='submit' name='deleteID' value=\"".$row2['id']."\">DEL</button>";
                            if($row2['fav'] == 1) {
                                echo "<span class='yellow'>[NICE]</span>"; // TODO BUTTON TO UNSTAR AND STAR
                            }
                            echo "<a class='link' href=\"".$row2['url']."\">".$row2['url']."</a>";
                            echo "</form></li>";
                        }
                        echo "</ul>";
                    }
                ?>
            </div>
        </div>

        <?php
            closeConnection($conn);
        ?>

    </body>

</html>