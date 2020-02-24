<?php
	ob_start();
	session_start();
	require_once("config.php");
    error_reporting(E_ALL & ~E_NOTICE );
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>投票</title>
    <style type="text/css">
        /*全局样式*/
        body {  font-size: 12pt; background:#E7F7F6; color: #333333; margin-top: 20px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;}
        table {font-size: 9pt; background:#E7F7F6; line-height: 20px; color: #333333}
        a:link { font-size: 9pt; color: #333333; text-decoration: none}
        a:visited { font-size: 9pt; color: #333333; text-decoration: none}
        a:hover { font-size: 9pt; color: #E7005C; text-decoration: underline}
        a:active { font-size: 9pt; color: #333333; text-decoration: none}
        input[type="radio"] {
            width: 20px;
            height: 20px;
            opacity: 0;
            display: inline-block;
            vertical-align: middle;
        }
        label {
            position: absolute;
            left: 5px;
            top: 3px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 1px solid #999;
            display: inline-block;
            vertical-align: middle;
        }
        input:checked+label {
            background-color: #41938A;
            border: 1px solid #41938A;
        }

        input:checked+label::after {
            position: absolute;
            content: "";
            width: 5px;
            height: 10px;
            top: 3px;
            left: 6px;
            border: 2px solid #fff;
            border-top: none;
            border-left: none;
            transform: rotate(45deg)
        }
        input[type="submit"] {
           background:#EA4481 ;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;

        }
        .processcon{
            background: #eee;
            height: 15px;
            position: relative;
            width: 200px;
            float: left;
            border-radius:3px;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            -webkit-transition:0.4s linear;
            -moz-transition:0.4s linear;
            -ms-transition:0.4s linear;
            -o-transition:0.4s linear;
            transition:0.4s linear;
            -webkit-transition-property:width, background-color;
            -moz-transition-property:width, background-color;
            -ms-transition-property:width, background-color;
            -o-transition-property:width, background-color;
            transition-property:width, background-color;
           }
        .process {background:#EA4481; height:15px;width:0px;
            border-radius:3px;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            /*background-image: linear-gradient( 135deg,pink 25%,transparent 25%,transparent 50%,pink 50%,pink 75%,transparent 75%,transparent 100%);*/
        }
        .clearfix {clear: both;}
        .protext {
            float: left;
            width: 50px;
            height: 15px;
        margin-left:10px;}
        @-webkit-keyframes load {
            0%{width:0%;}
            50%{width:50%}
            100%{width:100%}
        }
        /*全局样式结束*/
    </style>

    <script src="jquery.js"></script>

    <script language="javascript">
        function check()
        {
            node=frm.itm;
            flag=false;
            for(i=0;i<node.length;i++)
            {
                if(node[i].checked)
                {
                    flag=true;
                }
            }
            if(!flag)
            {
                alert("您没有选择")
                return false;
            }
            return true;
        }
    </script>
    <?php

    if($_POST["submit"]){

    if($_SESSION["vote"]==session_id())
    {
        ?>
        <script language="javascript">
            alert("您已经投票了");
            location.href="index.php?id=ck";
        </script>
    <?php
    exit();
    }
    $id=$_POST["itm"];
    $sql="update vote set count=count+1 where id=$id";
    if(mysqli_query($link,$sql))
    {
    $_SESSION["vote"]=session_id();
    ?>
        <script language="javascript">location.href="index.php?id=ck";</script>
    <?php
    }
    else
    {
    ?>
        <script language="javascript">alert("投票失败");location.href="index.php";</script>
        <?php
    }
    }
    ?>
    <script>


        jQuery(document).ready(function(){
            jQuery('.processcon').each(function(){
                jQuery(this).find('.process').animate({
                    width:jQuery(this).attr('data')
                },3000);
            });
        });
    </script>
</head>
<body>
<form name="frm" action="" method="post" onsubmit=return(check()) style="margin-bottom:5px;">
    <?php if($_GET["id"]!="ck"){?>
    <table width="365" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C2C2C2">
        <tr>
            <th bgcolor="#FFFFFF" style="color: #5ECDD1;">
                <?php
                $sql="select * from votetitle";
                $rs=mysqli_query($link,$sql);
                $row=mysqli_fetch_assoc($rs);
                echo $row["votetitle"];
                ?>	</th>
        </tr>
        <?php
        $sql="select * from vote";
        $rs=mysqli_query($link,$sql);
        while($rows=mysqli_fetch_assoc($rs))
        {
            ?>
            <tr>
                <td bgcolor="#FFFFFF" style="color: #41938A; position:relative;  display: table-cell;" ><input id="<?php echo $rows["id"]?>"  type="radio" name="itm" value="<?php echo $rows["id"]?>" /> <label for="<?php echo $rows["id"]?>"></label>&nbsp;&nbsp;<?php echo $rows["item"]?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td align="center" bgcolor="#FFFFFF"><input type="submit" name="submit" value="投票"/>
<!--                <input type="button" value="查看结果" onClick="location.href='index.php?id=ck'" /></td>-->
        </tr>
    </table>
    <?php } ?>
</form>
<?php if($_GET["id"]=="ck"){?>

    <?php
    $sql="select sum(count) as 'total' from vote";
    $rs=mysqli_query($link,$sql);
    $rows=mysqli_fetch_assoc($rs);
    $sum=$rows["total"];	 //得出总票数
    $sql="select * from vote";
    $rs=mysqli_query($link,$sql);
    ?>
    <table width="365" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C2C2C2" >
        <tr>
            <th bgcolor="#FFFFFF" style="color: #5ECDD1; width: 20%;">爱豆</th>
<!--            <th bgcolor="#FFFFFF">票数</th>-->
            <th bgcolor="#FFFFFF" style="color: #5ECDD1;width: 80%;">投票百分比</th>
        </tr>
        <?php
        while($rows=mysqli_fetch_assoc($rs))
        {
            ?>
            <tr>
                <td bgcolor="#FFFFFF"  style="color: #41938A;"><?php echo $rows["item"]?></td>
<!--                <td bgcolor="#FFFFFF">--><?php //echo $rows["count"]?><!--</td>-->
                <td bgcolor="#FFFFFF"  style="color: #41938A;">
                    <?php
                    $per=$rows["count"]/$sum;
                    $per=number_format($per,4);
                    ?>

                    <div class="processcon clearfix" data="<?php echo $per*200?>px">
                        <div class="process" ></div>

                    </div>
                    <div class="protext"> <?php echo $per*100?>%</div>
                 		</td>
            </tr>
            <?php
        }
        ?>
    </table>

<!--        <div align="center">-->
<!--            <a href="index.php" >隐藏结果</a>-->
<!--    </div>-->
<?php } ?>
</body>

</html>
 
