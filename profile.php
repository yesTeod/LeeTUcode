<?php include_once "components/head.php"; ?>

<body>
    <?php
    include_once "components/header.php";
    $joinedCourses = $dbHandler->getCoursesJoinedByUser($user->getID());
    $createdCourses = $dbHandler->getCoursesByCreatorId($user->getID());
    ?>
    <style>
        .course-container {
            display: flex;
            flex-wrap: wrap;
            margin-left: 70px;
        }

        .course-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 200px;
            min-height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-card h3 {
            color: #333;
        }
    </style>
    <main class="mb-5">
        <div class="container my-5">
            <div class="course-info bg-light border border-secondary rounded ps-3 pt-2 pe-3">
                <div class="row">
                    <div class="col-lg-12 mt-3 text-center">
                        <h1>
                            Profile
                        </h1>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 d-flex mb-3">
                        <h4>Name:</h4>
                        <p class="ps-3 pt-1">
                            <?php echo $user->getUsername(); ?>
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 d-flex mb-3">
                        <h4>Email:</h4>
                        <p class="ps-3 pt-1">
                            <?php echo $user->getEmail(); ?>
                        </p>
                    </div>
                </div>
                <div class="row mt-3 mb-5">
                    <div class="col-lg-12">
                        <?php if ($joinedCourses) { ?>
                            <h4>Joined courses:</h4>
                            <div class="course-container d-flex text-center" id="coursesContainer">
                                <?php foreach ($joinedCourses as $course) { ?>
                                    <a href="course.php?id=<?php echo $course["id"]; ?>" class="no-link-style">
                                        <div class="course-card d-flex align-items-center">
                                            <h3>
                                                <?php echo $course["name"]; ?>
                                            </h3>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="d-flex">
                                <h4>You haven't joined any courses yet :/</h4>
                                <p class="text-success pt-1 ps-2">it's never too late to start!</p>
                            </div>

                        <?php } ?>
                    </div>
                </div>
                <!-- displays unsolved tasks -->
                <div class="row mt-3 mb-5" id="due-tasks">
                    <div class="col-lg-12">
                        <?php if ($dueTasks) { ?>
                            <h4>Tasks Due:</h4>
                            <div class="course-container d-flex text-center" id="coursesContainer">
                                <?php foreach ($dueTasks as $task) { ?>
                                    <a href="task.php?id=<?php echo $task["id"]; ?>" class="no-link-style">
                                        <div class="course-card d-flex align-items-center flex-column" title="On <?php echo $dbHandler->getCourseById($task["course_id"])["name"]; ?>">
                                            <h3>
                                                <?php echo $task["name"]; ?>
                                            </h3>
                                            <h3 class="text-danger">
                                                <?php
                                                if ($dbHandler->getTaskSubmitionsOfUserForTask($user->getID(), $task["id"])) {
                                                    echo ("(Attempted)");
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="d-flex">
                                <h4>You have no tasks due.</h4>
                            </div>

                        <?php } ?>
                    </div>
                </div>
                <?php if ($user->getAccountType() == "teacher") { ?>
                    <div class="row mt-3 mb-5">
                        <div class="col-12">
                            <h4>My courses:</h4>
                            <div class="course-container d-flex text-center" id="coursesContainer">
                                <?php foreach ($createdCourses as $course) { ?>
                                    <a href="course.php?id=<?php echo $course["id"]; ?>" class="no-link-style">
                                        <div class="course-card d-flex align-items-center">
                                            <h3>
                                                <?php echo $course["name"]; ?>
                                            </h3>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <a href="createCoursePage.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Create a
                                course</a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
</body>