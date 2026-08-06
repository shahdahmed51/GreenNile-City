<?php
$requestId = $_GET['id'] ?? '';
$requests = [
    [
        "id"=>"MR001",
        "title"=>"Water leakage in kitchen",
        "resident"=>"Ahmed Hassan",
        "apartment"=>"A-205",
        "category"=>"Plumbing",
        "priority"=>"High",
        "status"=>"In Progress",
        "date"=>"12 May 2026",
        "assigned"=>"Ahmed Hassan",
        "phone"=>"+20 100 123 4567",
        "email"=>"ahmed@greennile.com",
        "description"=>"Water leakage has been reported under the kitchen sink."
    ],
    [
        "id"=>"MR002",
        "title"=>"AC not cooling",
        "resident"=>"Habiba Emad",
        "apartment"=>"B-110",
        "category"=>"Electrical",
        "priority"=>"Medium",
        "status"=>"Pending",
        "date"=>"11 May 2026",
        "assigned"=>"Mohamed Ali",
        "phone"=>"+20 100 789 123 4567",
        "email"=>"mohamed@greennile.com",
        "description"=>"The air conditioner is not cooling properly."
    ],
    [
        "id"=>"MR003",
        "title"=>"Parking gate not working",
        "resident"=>"Karim Ahmed",
        "apartment"=>"C-305",
        "category"=>"General",
        "priority"=>"High",
        "status"=>"In Progress",
        "date"=>"11 May 2026",
        "assigned"=>"Ali Mohmed",
        "phone"=>"+20 100 891 234 5678",
        "email"=>"ali@greennile.gom",
        "description"=>"Main parking gate does not open with access cards."
    ],
    [
        "id"=>"MR004",
        "title"=>"Light flickering",
        "resident"=>"Nour Ali",
        "apartment"=>"A-102",
        "category"=>"Electrical",
        "priority"=>"Low",
        "status"=>"Completed",
        "date"=>"10 May 2026",
        "assigned"=>"Youssef Samir",
        "phone"=>"+20 100 912 345 6789",
        "email"=>"youssef@greennile.com",
        "description"=>"Bedroom light keeps flickering."
    ],
    [
        "id"=>"MR005",
        "title"=>"Elevator not working",
        "resident"=>"Nada Mohamed",
        "apartment"=>"D-402",
        "category"=>"Mechanical",
        "priority"=>"High",
        "status"=>"Pending",
        "date"=>"13 May 2026",
        "assigned"=>"Ahmed Mostafa",
        "phone"=>"+20 100 125 378 9647",
        "email"=>"ahmed@greennile.com",
        "description"=>"Elevator has stopped working since morning."
    ]
];
$request = null;
foreach($requests as $item){
    if($item["id"] == $requestId){
        $request = $item;
        break;
    }
}
if(!$request){
    die("Request Not Found");
}
?>
<?php include("../includes/header.php"); 
?>
<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/maintenanceReq.css">
   
<div class="main-content-full">
    <a href="maintenance.php" class="back-btn">
        <i class="bi bi-arrow-left"></i>
        Back to Maintenance Requests
    </a>

    <div class="page-header">
        <h2>Maintenance Request Details</h2>
        <p>Request ID : <strong><?=$requestId?></strong></p>
    </div>

    <div class="details-container">
        <!---left side--->
        <div class="left-side">

            <div class="request-card">

                <div class="card-title">
                    <h3>Request Information</h3>
                </div>
                <div class="request-info">
                    <div class="info-box">
                        <span>Request ID</span>
                        <p><?=$request["id"]?></p>
                    </div>
                    <div class="info-box">
                        <span>Resident</span>
                        <p><?=$request["resident"]?></p>
                    </div>
                    <div class="info-box">
                        <span>Apartment</span>
                        <p><?=$request["apartment"]?></p>
                    </div>
                    <div class="info-box">
                        <span>Category</span>
                        <p><?=$request["category"]?></p>
                    </div>
                    <div class="info-box">
                        <span>Priority</span>
                       <span class="priority <?= strtolower($request['priority']) ?>">
                       <?= $request["priority"] ?>
                       </span>
                    </div>
                    <div class="info-box">
                        <span>Status</span>
                       <span class="status <?= strtolower(str_replace(' ','-',$request['status'])) ?>">
                       <?= $request["status"] ?>
                       </span>
                    </div>
                </div>

                    <div class="description">
                       <h4>Description</h4>
                       <p><?= $request["description"] ?></p>
                    </div>

            </div>
            <div class="update-card">
                <div class="card-title">
                     <h3>Update Status</h3>
                </div>
                <form action="" method="post">
                  <div class="form-group">
                  <label>Update Status</label>
                     <select class="form-control">
                           <option>Pending</option>
                           <option selected>In Progress</option>
                           <option>Completed</option>
                     </select>

                    </div>
                   <div class="form-group">
                   <label>Assign Technician</label>
                  <select class="form-control">
                          <option>Ahmed Hassan</option>
                          <option>Mohamed Ali</option>
                          <option>Omar Khaled</option>
                         <option>Youssef Samir</option>
                         <option>Ahmed Mostafa</option>
                    </select>
                   </div>
                  <div class="form-group">
                      <label>Notes</label>
                     <textarea class="form-control" rows="5"
                       placeholder="Write your notes here..."></textarea>
                  </div>
                 <div class="btn-group">
                     <button type="submit" class="save-btn">
                         <i class="bi bi-check-circle"></i>
                              Save Changes
                      </button>
                      <button type="button" class="close-btn">
                            <i class="bi bi-x-circle"></i>
                            Close Request
                       </button>

                  </div>

                </form>

            </div>

        </div>
             <!----right side--->
             <div class="right-side">
                <div class="technician-card">
                    <div class="card-title">
                          <h3>Assigned Technicain</h3>
                    </div>
                    <div class="technician-info">
                       <div class="tech-avatar">
                         <i class="bi bi-person-fill"></i>
                        </div>
                         <h4><?= $request["assigned"] ?></h4>
                          <p class="job-title">
                                  Maintenance Technician
                          </p>
                          <div class="tech-details">
                         <div class="detail-row">
                           <i class="bi bi-telephone-fill"></i>
                           <span><?= $request["phone"] ?></span>
                         </div>
                         <div class="detail-row">
                          <i class="bi bi-envelope-fill"></i>
                          <span><?= $request["email"] ?></span>
                         </div>
                        </div>
                        <button class="contact-btn">
                           Contact Technician
                            </button>
                        </div>
                </div>

                <div class="timeline-card">
                    <div class="card-title">
                         <h3>Timeline</h3>
                    </div>
                    <div class="timeline">
                        <div class="timeline-item">
                         <div class="timeline-dot"></div>

                          <div class="timeline-content">
                                 <h5>Request Submitted</h5>
                                 <small><?= $request["date"] ?></small>
                            </div>
                        </div>
                      <div class="timeline-item">
                         <div class="timeline-dot active"></div>
                         <div class="timeline-content">
                             <h5>Technician Assigned</h5>
                             <small>Same Day</small>
                         </div>
                        </div>
                        <div class="timeline-item">
                           <div class="timeline-dot"></div> 
                          <div class="timeline-content">
                              <h5>Status</h5>
                             <small><?= $request["status"] ?></small>
                           </div>
                        </div>
                    </div>
                </div>

             </div>
        </div>
</div>

<script src="/GREENNILE-CITY/assets/js/maintenanceReq.js"></script>
 <?php include("../includes/footer.php"); ?>