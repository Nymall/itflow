<div class="modal" id="editLocationModal<?php echo $location_id; ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-white"><i class="fa fa-fw fa-map-marker-alt mr-2"></i><?php echo $location_name; ?></h5>
        <button type="button" class="close text-white" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="post.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="location_id" value="<?php echo $location_id; ?>">
        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
        <input type="hidden" name="current_file_path" value="<?php echo $location_photo; ?>">
        <div class="modal-body bg-white">

          <ul class="nav nav-pills nav-justified mb-3" id="pills-tab<?php echo $location_id; ?>">
            <li class="nav-item">
              <a class="nav-link active" id="pills-details-tab<?php echo $location_id; ?>" data-toggle="pill" href="#pills-details<?php echo $location_id; ?>">Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-address-tab<?php echo $location_id; ?>" data-toggle="pill" href="#pills-address<?php echo $location_id; ?>">Address</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab<?php echo $location_id; ?>" data-toggle="pill" href="#pills-contact<?php echo $location_id; ?>">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-photo-tab<?php echo $location_id; ?>" data-toggle="pill" href="#pills-photo<?php echo $location_id; ?>">Photo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-notes-tab<?php echo $location_id; ?>" data-toggle="pill" href="#pills-notes<?php echo $location_id; ?>">Notes</a>
            </li>
          </ul>

          <hr>

          <div class="tab-content" id="pills-tabContent<?php echo $location_id; ?>">

            <div class="tab-pane fade show active" id="pills-details<?php echo $location_id; ?>">

              <div class="form-group">
                <label>Location Name <strong class="text-danger">*</strong></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-fw fa-map-marker"></i></span>
                  </div>
                  <input type="text" class="form-control" name="name" placeholder="Name of location" value="<?php echo $location_name; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label>Phone</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-fw fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" name="phone" placeholder="Phone Number" data-inputmask="'mask': '999-999-9999'" value="<?php echo $location_phone; ?>"> 
                </div>
              </div>

            </div>

            <div class="tab-pane fade" id="pills-address<?php echo $location_id; ?>">

              <div class="form-group">
                <label>Address</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-fw fa-map-marker-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $location_address; ?>">
                </div>
              </div>

              <div class="form-group">
                <label>City</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-fw fa-city"></i></span>
                  </div>
                  <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo $location_city; ?>">
                </div>
              </div>
              
              <div class="form-group">
                <label>State</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-fw fa-flag"></i></span>
                  </div>
                  <select class="form-control select2" name="state">
                    <?php foreach($states_array as $state_abbr => $state_name) { ?>
                    <option <?php if($location_state == $state_abbr) { echo "selected"; } ?> value="<?php echo $state_abbr; ?>"><?php echo $state_name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <label>Zip</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-fw fa-usps"></i></span>
                  </div>
                  <input type="text" class="form-control" name="zip" placeholder="Postal Code" value="<?php echo $location_zip; ?>">
                </div>
              </div>

              <div class="form-group">
                <label>Country</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-fw fa-flag"></i></span>
                  </div>
                  <select class="form-control select2" name="country">
                    <option value="">- Country -</option>
                    <?php foreach($countries_array as $country_name) { ?>
                    <option <?php if($location_country == $country_name) { echo "selected"; } ?>><?php echo $country_name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

            </div>

            <div class="tab-pane fade" id="pills-contact<?php echo $location_id; ?>">

              <div class="form-group">
                <label>Contact</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
                  </div>
                  <select class="form-control" name="contact">
                    <option value="">- Contact -</option>
                    <?php 
                    
                    $sql_contacts = mysqli_query($mysqli,"SELECT * FROM contacts WHERE client_id = $client_id ORDER BY contact_name ASC"); 
                    while($row = mysqli_fetch_array($sql_contacts)){
                      $contact_id_select = $row['contact_id'];
                      $contact_name_select = $row['contact_name'];

                    ?>
                      <option <?php if($contact_id == $contact_id_select){ echo "selected"; } ?> value="<?php echo $contact_id_select; ?>"><?php echo $contact_name_select; ?></option>
                    
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>

              <label>Phone</label>
              <div class="form-row">
                <div class="col-8">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-fw fa-phone"></i></span>
                      </div>
                      <input type="text" class="form-control" name="phone" placeholder="Phone Number" data-inputmask="'mask': '999-999-9999'" value="<?php echo $contact_phone; ?>" disabled> 
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <input type="text" class="form-control" name="extension" placeholder="Extension" value="<?php echo $contact_extension; ?>" disabled>
                </div>
              </div>

              <div class="form-group">
                <label>Mobile</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-fw fa-mobile-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="mobile" placeholder="Mobile Phone Number" data-inputmask="'mask': '999-999-9999'" value="<?php echo $contact_mobile; ?>" disabled> 
                </div>
              </div>

              <div class="form-group">
                <label>Email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?php echo $contact_email; ?>" disabled>
                </div>
              </div>
              
              <div class="form-group">
                <label>Hours</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-fw fa-clock"></i></span>
                  </div>
                  <input type="text" class="form-control" name="hours" placeholder="Hours of operation" value="<?php echo $location_hours; ?>"> 
                </div>
              </div>

            </div>

            <div class="tab-pane fade" id="pills-photo<?php echo $location_id; ?>">

              <div class="form-group">

                <center>
                  <?php if(!empty($location_photo)){ ?>
                  <img class="img-fluid rounded-circle" src="<?php echo $location_photo; ?>" height="256" width="256">
                  <?php } ?>
                </center>

                <input type="file" class="form-control-file" name="file">
              </div>

            </div>

            <div class="tab-pane fade" id="pills-notes<?php echo $location_id; ?>">

              <div class="form-group">
                <textarea class="form-control" rows="8" name="notes"><?php echo $location_notes; ?></textarea>
              </div>

            </div>

          </div>

        </div>
        <div class="modal-footer bg-white">
          <a href="post.php?delete_location=<?php echo $location_id; ?>" class="btn btn-danger mr-auto"><i class="fa fa-trash text-white"></i></a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="edit_location" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>