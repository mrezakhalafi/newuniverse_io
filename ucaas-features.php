<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-ib.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-ib-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/ib-nav.php'); ?>

<title>IndonesiaBisa - UCaaS</title>

<style>
    #heading {
        margin-top: 15rem;
        /* margin-left: 10rem; */
    }

    .tagline {
        font-size: 3.25rem;
    }

    #wave-wrap {
        padding: 0;
    }

    #wave {
        max-width: 100%;
        height: auto;
    }

    .strong {
        font-weight: 600;
    }

    .ico-sm {
        max-height: 30px;
        width: auto;
    }

    .ico-lg {
        max-height: 80px;
        width: auto;
    }

    .btn-green {
        border-radius: 10px;
        background-color: #007a87;
        color: white;
    }

    .card {
        padding: 0;
        border-radius: 20px !important;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
    }

    .card .card-body {
        padding: 15px;
    }

    .card-yellow {
        background-color: #f2ad33;
        padding: 30px !important;
    }

    #track {
        background-color: #007a87;
    }

    #future {
        background-color: #f2ad33;
    }

    @media (max-width:1023px) {
        .tagline {
            font-size: 2.25rem;
            text-align: center;
        }

        .card-lg {
            margin: 1rem 0;
        }

        .card-track {
            margin: 0 1rem;
        }

        #track,
        #future {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        #future .card-track {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        #structure {
            padding-left: 2rem;
            padding-right: 2rem;
        }
    }

    @media (min-width: 1024px) {
        #wave-wrap {
            /* padding: 0; */
            margin-top: 8rem;
        }

        #communicate {
            margin-top: -10rem;
        }

        .col-right {
            float: right;
        }

        #track {
            padding: 40px 40px 40px 60px;
            background-color: #007a87;
            border-radius: 0 1.25rem 1.25rem 0;
        }

        #track-container {
            margin: 10rem 0;
        }

        #future {
            padding: 40px 60px 40px 40px;
            background-color: #f2ad33;
            border-radius: 1.25rem 0 0 1.25rem;
            float: right !important;
        }

        #future-container {
            margin: 10rem 0;
        }

        #main-tagline {
            text-align: right;
        }
    }
</style>

<!-- wave -->
<div class="container-fluid" id="wave-wrap">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <img src="ucaas_assets\img\enterprise\wave2.png" id="wave">
        </div>
    </div>
</div>

<!-- features start -->
<div class="container mb-4" id="communicate">
    <div class="row">
        <div class="col-md-12 col-lg-8 ml-auto">
            <h1 class="fontRobBold tagline" id="main-tagline">
                Communicate better with the whole organization
            </h1>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-12 col-lg-12 ml-auto" id="discover">
            <!-- <div class="row align-items-center"> -->
            <!-- <div class="col-lg-12"> -->
            <div class="col-lg-4 col-right">
                <div class="card card-lg">
                    <div class="card-body">
                        <img src="ucaas_assets\img\enterprise\icons_timeline.png" class="ico-lg mr-3 mb-2">
                        <h4 class="card-title fontRobReg strong">
                            Discover & Timeline
                        </h4>
                        <p class="fontRobReg card-text m-0 fs-18">
                            Get all the news and updates from your organization.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-right">
                <div class="card card-lg">
                    <div class="card-body">
                        <img src="ucaas_assets\img\enterprise\icons_related_conversation.png" class="ico-lg mr-3 mb-2">
                        <h4 class="card-title fontRobReg strong">
                            Unified Messaging
                        </h4>
                        <p class="fontRobReg card-text m-0 fs-18">
                            Messaging, email, voicemail, and file sharing in one interface.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-right">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title fontRobReg strong m-0">
                            <img src="ucaas_assets\img\enterprise\icons_calling.png" class="ico-sm mr-2">
                            Calling
                        </h4>
                    </div>
                </div>
                <div class="card my-3">
                    <div class="card-body">
                        <h4 class="card-title fontRobReg strong m-0">
                            <img src="ucaas_assets\img\enterprise\icons_live_line.png" class="ico-sm mr-2">
                            Live Streaming
                        </h4>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title fontRobReg strong m-0">
                            <img src="ucaas_assets\img\enterprise\icons_emaill_green.png" class="ico-sm mr-2">
                            Email
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="track-container">
    <div class="row">
        <div class="col-md-12 col-lg-10" id="track">
            <div class="row">
                <div class="col-lg-3 align-self-center">
                    <h1 class="ny-auto tagline fontRobBold">
                        Keep track and record of your works
                    </h1>
                </div>
                <div class="col-lg-3 card-track">
                    <div class="card card-lg">
                        <div class="card-body">
                            <img src="ucaas_assets\img\enterprise\icons_work_assignment_green.png" class="ico-lg mr-3 mb-2">
                            <h4 class="card-title fontRobReg strong">
                                Work Assignment
                            </h4>
                            <p class="fontRobReg card-text m-0 fs-18">
                                Assign and delegate tasks to the right people.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 card-track">
                    <div class="card card-lg">
                        <div class="card-body">
                            <img src="ucaas_assets\img\enterprise\icons_incoming_task.png" class="ico-lg mr-3 mb-2">
                            <h4 class="card-title fontRobReg strong">
                                Project Management
                            </h4>
                            <p class="fontRobReg card-text m-0 fs-18">
                                Manage all the ongoing, incoming, and overdue tasks.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 card-track">
                    <div class="card card-lg">
                        <div class="card-body">
                            <img src="ucaas_assets\img\enterprise\icons_reminder_green.png" class="ico-lg mr-3 mb-2">
                            <h4 class="card-title fontRobReg strong">
                                Unified Messaging
                            </h4>
                            <p class="fontRobReg card-text m-0 fs-18">
                                Always there to let you know all the important dates for your work and appointment.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="future-container">
    <div class="row">
        <div class="col-md-12 col-lg-10 ml-auto" id="future">
            <div class="row">
                <div class="col-lg-3 align-self-center ml-auto order-lg-2">
                    <h1 class="tagline fontRobBold ml-auto">
                        The future of productivity
                    </h1>
                </div>
                <div class="col-lg-9 order-lg-1">
                    <div class="row">
                        <!--Carousel Wrapper-->
                        <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
                            <div class="carousel-inner" role="listbox" style="overflow: unset;">
                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-lg-4 card-track">
                                            <div class="card card-lg">
                                                <div class="card-body">
                                                    <img src="ucaas_assets\img\enterprise\icons_expense_green.png" class="ico-lg mr-3 mb-2">
                                                    <h4 class="card-title fontRobReg strong">
                                                        Expense Management
                                                    </h4>
                                                    <p class="fontRobReg card-text m-0 fs-18">
                                                        Manage all your finances such as reimbursement, cash advance request, and overtime claim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 card-track">
                                            <div class="card card-lg">
                                                <div class="card-body">
                                                    <img src="ucaas_assets\img\enterprise\icons_attendance_green.png" class="ico-lg mr-3 mb-2">
                                                    <h4 class="card-title fontRobReg strong">
                                                        Attendance Management
                                                    </h4>
                                                    <p class="fontRobReg card-text m-0 fs-18">
                                                        Record your daily attendance, overtime, and annual leave.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 card-track">
                                            <div class="card card-lg">
                                                <div class="card-body">
                                                    <img src="ucaas_assets\img\enterprise\icons_meeting_invitation_green.png" class="ico-lg mr-3 mb-2">
                                                    <h4 class="card-title fontRobReg strong">
                                                        Meeting
                                                    </h4>
                                                    <p class="fontRobReg card-text m-0 fs-18">
                                                        Hold a meeting with everyone, at anytime and anywhere.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">

                                        <div class="col-lg-4 card-track">
                                            <div class="card card-lg">
                                                <div class="card-body">
                                                    <img src="ucaas_assets\img\enterprise\icons_lunch_green.png" class="ico-lg mr-3 mb-2">
                                                    <h4 class="card-title fontRobReg strong">
                                                        Lunch
                                                    </h4>
                                                    <p class="fontRobReg card-text m-0 fs-18">
                                                        Request what your lunch will be.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 card-track">
                                            <div class="card card-lg">
                                                <div class="card-body">
                                                    <img src="ucaas_assets\img\enterprise\icons_complaint_green.png" class="ico-lg mr-3 mb-2">
                                                    <h4 class="card-title fontRobReg strong">
                                                        Complaint
                                                    </h4>
                                                    <p class="fontRobReg card-text m-0 fs-18">
                                                        Manage and resolve customer complaints with the right person.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 card-track">
                                            <div class="card card-lg">
                                                <div class="card-body">
                                                    <img src="ucaas_assets\img\enterprise\icons_calendar_green.png" class="ico-lg mr-3 mb-2">
                                                    <h4 class="card-title fontRobReg strong">
                                                        Agenda
                                                    </h4>
                                                    <p class="fontRobReg card-text m-0 fs-18">
                                                        Stay organized. Schedule and monitor your tasks, meetings, and appointments.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">

                                        <div class="col-lg-4 card-track">
                                            <div class="card card-lg">
                                                <div class="card-body">
                                                    <img src="ucaas_assets\img\enterprise\icons_event_green.png" class="ico-lg mr-3 mb-2">
                                                    <h4 class="card-title fontRobReg strong">
                                                        Event
                                                    </h4>
                                                    <p class="fontRobReg card-text m-0 fs-18">
                                                        Host an event and let everyone know.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 card-track">
                                            <div class="card card-lg">
                                                <div class="card-body">
                                                    <img src="ucaas_assets\img\enterprise\icons_request_driver_green.png" class="ico-lg mr-3 mb-2">
                                                    <h4 class="card-title fontRobReg strong">
                                                        Transportation
                                                    </h4>
                                                    <p class="fontRobReg card-text m-0 fs-18">
                                                        Ask for drivers to get you wherever you need to be.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 card-track">
                                            <div class="card card-lg">
                                                <div class="card-body">
                                                    <img src="ucaas_assets\img\enterprise\icons_complaint_green.png" class="ico-lg mr-3 mb-2">
                                                    <h4 class="card-title fontRobReg strong">
                                                        Complaint
                                                    </h4>
                                                    <p class="fontRobReg card-text m-0 fs-18">
                                                        Manage and resolve customer complaints with the right person.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
                                <li data-target="#multi-item-example" data-slide-to="1"></li>
                                <li data-target="#multi-item-example" data-slide-to="2"></li>
                            </ol>
                            <!--/.Indicators-->
                        </div>
                        <!--/.Carousel Wrapper-->
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-3">
                    <h1 class="tagline fontRobBold align-self-center" style="float:right;">
                        The future of productivity
                    </h1>
                </div> -->
        </div>
    </div>
</div>

<div class="container mt-5 mb-3">
    <div class="row">
        <div class="col-md-12 col-lg-12">

            <h1 class="tagline fontRobBold mb-4">
                Know your company<br>
                Don't be the last to know
            </h1>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-4" id="structure">
            <div class="card card-lg mb-5">
                <div class="card-body">
                    <img src="ucaas_assets/img/enterprise/icons_organization_green.png" class="ico-lg mb-2">
                    <h4 class="card-title fontRobReg strong">
                        Structure Organization
                    </h4>
                    <p class="fontRobReg card-text m-0 fs-18">
                        Get to know people who don’t even work directly with you.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-3 mt-5" style="margin-top: 100px; background-color:#f4f4f4;">
    <div class="row">
        <div class="col-lg-3 mx-auto">
            <div class="card card-lg card-yellow text-center">
                <div class="card-body">
                    <img class="text-center" src="ucaas_assets/img/enterprise/Group 10.png" style="height: 20px; width: auto; margin: 1rem 0 1.5rem 0;">

                    <h1 class="fontRobReg card-text" style="color:white;">
                        Ready to transform your work life.
                    </h1>

                </div>
                <div class="card-footer">
                    <button class="btn btn-green">Contact Sales</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-ib.php'); ?>