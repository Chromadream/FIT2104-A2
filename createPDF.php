<?php

class createPDF
{
    function clientPDF($header,$headerWidth,$data)
    {
        define('K_PATH_IMAGES','images/');
        $PDF_HEADER_LOGO = "FamoxLogo.png";
        $PDF_HEADER_LOGO_WIDTH = "20";

        $PDF = new TCPDF('L',PDF_UNIT,PDF_PAGE_FORMAT,true);

        $PDF->SetHeaderData($PDF_HEADER_LOGO,$PDF_HEADER_LOGO_WIDTH,"Famox Client List",'');
        $PDF->SetHeaderFont(array(PDF_FONT_NAME_MAIN,'',20));
        $PDF->SetFooterFont(array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
        $PDF->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED,'',12);

        $PDF->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
        $PDF->SetHeaderMargin(PDF_MARGIN_HEADER);
        $PDF->SetFooterMargin(PDF_MARGIN_FOOTER);

        $PDF->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);

        $PDF->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $PDF->AddPage();
        $PDF->Ln();

        $table = '<table cellpadding="5" cellspacing="5" border="0">';
        $table.='<tr bgcolor="#368">';

        for($i = 0;$i < sizeof($header);$i++)
        {
            $table.='<td class="heading" width="'.$headerWidth[$i].'">'.$header[$i].'</td>';
        }
        $table.="</tr>";

        $rowCount=0;

        foreach($data as $row)
        {
            if($rowCount%2==0)
            {
                $table.='<tr valign="top" bgcolor="#c1d1db">';
            }
            else
            {
                $table.='<tr valign="top">';
            }
            $table.="<td>".$row["client_id"]."</td>";
            $table.="<td>".$row["client_fname"]." ".$row["client_lname"]."</td>";
            $table.="<td>".$row["client_street"]."<br />".$row["client_suburb"]." ".$row["client_state"]."<br />".$row["client_pc"]."</td>";
            $table.="<td>".$row["client_email"]."</td>";
            $table.="<td>".$row["client_mobile"]."</td>";
            $table.="<td>".$row["client_mailinglist"]."</td>";
            $table.="</tr>";
            $rowCount++;
        }
        $table.="</table>";
        $PDF->writeHTML($table,true,true,true,true,'');
        $saveDir = dirname($_SERVER["SCRIPT_FILENAME"]).'/PDFS/';
        if($PDF->Output($saveDir.'Clients.pdf','F'))
        {
            return $table;
        }
        exit();
    }
}