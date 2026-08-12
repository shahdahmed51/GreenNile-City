<?php $current_page = basename($_SERVER['PHP_SELF']);?>
<?php include("../includes/header.php"); 
?>
<?php include("../includes/user-sidebar.php"); ?>
<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/maintenance.css">
     <div class="main-content">

           <div class="page-header">
            <h2> My Maintenance Requests</h2>
            <p>View and track your maintenance requests.</p>
           </div>

           <div class="maintenance-card">

            <div class="top-bar">

                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" placeholder="Search requests...">
                </div>

                <select name="" id="statusFilter">
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="in progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>

                <a href="add-maintenanceUser.php" class="new-btn">
                    <i class="bi bi-plus-lg"></i>
                     New Request
               </a>
            </div>

            <?php
            $requests =[
                [
                    "id"=>"MR001",
                    "title"=>"Water leakege in kitchen",
                    "category"=>"plumbing",
                    "priority"=>"High",
                    "status"=>"In Progress",
                    "date"=>"12 May 2026",
                    "assigned"=>"Ahmed Hassen"
                ],
                [
                     "id" => "MR002",
                     "title" => "AC not cooling",
                     "category" => "Electrical",
                     "priority" => "Medium",
                     "status" => "Pending",
                     "date" => "11 May 2026",
                     "assigned" => "Habiba Emad"
                ],
                [
                     "id" => "MR003",
                     "title" => "Parking gate not working",
                     "category" => "General",
                     "priority" => "High",
                     "status" => "In Progress",
                    "date" => "11 May 2026",
                     "assigned" => "Karim Ahmed"
                ],
                [
                    "id" => "MR004",
                    "title" => "Light flickering",
                    "category" => "Electrical",
                    "priority" => "Low",
                    "status" => "Completed",
                    "date" => "10 May 2026",
                    "assigned" => "Nour Ali"
               ],
               [
                    "id" => "MR005",
                    "title" => "Elevator not working",
                    "category" => "Mechanical",
                    "priority" => "High",
                    "status" => "Pending",
                    "date" => "13 May 2026",
                    "assigned" => "Nada Mohmed"
            ]
           ];
            ?>

             <table class="table table-hover align-middle text-center">
                     <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Assigned To</th>
                            <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($requests as $request):?>
                            <tr>
                                <td><?=$request["id"]?></td>
                                <td><?=$request["title"]?></td>
                                <td><?=$request["category"]?></td>
                                <td>
                                    <span class="priority <?=strtolower($request["priority"])?>">
                                         <?=$request["priority"]?>
                                    </span>
                                </td>
                                <td>
                                    <span class="status <?=strtolower(str_replace(' ','-',$request["status"]))?>">
                                           <?=$request["status"]?>
                                    </span>
                                </td>
                                <td><?=$request["date"]?></td>
                                <td><?=$request["assigned"]?></td>
                                <td>
                                    <a href="maintenanceReq-user.php?id=<?=$request['id']?>" class="action-btn view">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                     </tbody>
             </table>
           </div>
     </div>
 <script src="/GreenNile-City/assets/js/maintenance.js"></script>
 <?php include("../includes/footer.php"); ?>