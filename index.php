<?php   
include_once ($_SERVER['DOCUMENT_ROOT']."/core/class_config.php");

    include_once ($_SERVER['DOCUMENT_ROOT']."/".$GLOBALS['SITE_PREFIX']."header.html");
    include_once ($_SERVER['DOCUMENT_ROOT']."/".$GLOBALS['SITE_PREFIX']."menu.php");

    if (isset($_GET['menu']))
    {
	    $menu = $_GET['menu'];
    }else
    {
	    $menu = "";
    }
    
    switch ($menu)
    {
        case "extraservices":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/services/extraservices.php");
        }break;
        
        case "repairservices":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/services/repairservices.php");
        }break;

        case "history":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/trivial_pages/".$GLOBALS['SITE_PREFIX']."history.php");
        }break;

        case "activities":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/trivial_pages/".$GLOBALS['SITE_PREFIX']."activities.php");
        }break;

        case "cooperation":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/trivial_pages/".$GLOBALS['SITE_PREFIX']."cooperation.php");
        }break;  

        case "workers":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/trivial_pages/".$GLOBALS['SITE_PREFIX']."workers.php");
        }break;  

        case "workschedule":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/trivial_pages/".$GLOBALS['SITE_PREFIX']."workschedule.php");
        }break; 

        case "contactdetails":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/trivial_pages/".$GLOBALS['SITE_PREFIX']."contactdetails.php");
        }break;

        case "prices":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/prices_and_documents/prices.php");
        }break;

        case "prices_details":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/prices_and_documents/prices_details.php");
        }break;

        case "adminservices":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/services/adminservices.php");
        }break;

        case "adminservices_details":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/services/adminservices_details.php");
        }break; 

        case "feedback":
        {
            include ("./feedback.php");
        }break;

        case "news":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/news/page_news.php");
        }break;

        case "news_details":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/news/page_news_details.php");
        }break;

        case "schedules":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/schedules_cleaning.php");
        }break;

        case "schedules_cleaning":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/schedules_cleaning.php");
        }break;

        case "schedules_plumbing":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/schedules_plumbing.php");
        }break;

        case "schedules_chimneys":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/schedules_maintenance/schedules_chimneys.php");
        }break;
        
        case "all_works":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/work/all_works.php");
        }break;
        
        case "works_at_address":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/work/works_at_address.php");
        }break;
        
        case "financial_statements":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/trivial_pages/".$GLOBALS['SITE_PREFIX']."financial_statements.php");
        }break;
        
        case "laws":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/trivial_pages/laws.php");
        }break;
        
        case "job":
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/trivial_pages/".$GLOBALS['SITE_PREFIX']."job.php");
        }break;

        default:
        {
            include ($_SERVER['DOCUMENT_ROOT']."/core/news/page_news.php");
        }

    }


    include ("./footer.html");
?>
