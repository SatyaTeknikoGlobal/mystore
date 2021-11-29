<!-- Account Settings starts -->
<div class="row">
  <div class="col-md-3 mt-3">
    <!-- Nav tabs -->
    <ul class="nav flex-column nav-pills" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general"
          aria-selected="true">
          <i class="ft-settings mr-1 align-middle"></i>
          <span class="align-middle">General</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password" role="tab"
          aria-controls="change-password" aria-selected="false">
          <i class="ft-lock mr-1 align-middle"></i>
          <span class="align-middle">Change Password</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info"
          aria-selected="false">
          <i class="ft-info mr-1 align-middle"></i>
          <span class="align-middle">Info</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="social-links-tab" data-toggle="tab" href="#social-links" role="tab"
          aria-controls="social-links" aria-selected="false">
          <i class="ft-twitter mr-1 align-middle"></i>
          <span class="align-middle">Social Links</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="connections-tab" data-toggle="tab" href="#connections" role="tab"
          aria-controls="connections" aria-selected="false">
          <i class="ft-link mr-1 align-middle"></i>
          <span class="align-middle">Connections</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab"
          aria-controls="notifications" aria-selected="false">
          <i class="ft-bell mr-1 align-middle"></i>
          <span class="align-middle">Notifications</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="col-md-9">
    <!-- Tab panes -->
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <div class="tab-content">
            <!-- General Tab -->
            <div class="tab-pane active" id="general" role="tabpanel" aria-labelledby="general-tab">
              <div class="media">
                <img src="../app-assets/img/portrait/small/avatar-s-8.png" alt="profile-img" class="rounded mr-3"
                  height="64" width="64">
                <div class="media-body">
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-start px-0 mb-sm-2">
                    <label class="btn btn-sm bg-light-primary mb-sm-0" for="select-files">Upload Photo</label>
                    <input type="file" id="select-files" hidden>
                    <button class="btn btn-sm bg-light-secondary ml-sm-2">Reset</button>
                  </div>
                  <p class="text-muted mb-0 mt-1 mt-sm-0">
                    <small>Allowed JPG, GIF or PNG. Max size of 800kB</small>
                  </p>
                </div>
              </div>
              <hr class="mt-1 mt-sm-2">
              <form novalidate>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="username">Username</label>
                    <div class="controls">
                      <input type="text" id="username" class="form-control" placeholder="Username" value="hermione007"
                        required>
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <label for="name">Name</label>
                    <div class="controls">
                      <input type="text" id="name" class="form-control" placeholder="Name" value="Hermione Granger"
                        required>
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <label for="email">E-mail</label>
                    <div class="controls">
                      <input type="text" id="email" class="form-control" placeholder="E-mail"
                        value="granger007@hogward.com" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="alert bg-light-warning alert-dismissible mb-2">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ft-x font-medium-2 text-bold-700"></i></span>
                      </button>
                      <p class="mb-0">Your email is not confirmed. Please check your inbox.</p>
                      <a href="javascript:;" class="alert-link">Resend confirmation</a>
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <label for="company">Company</label>
                    <div class="controls">
                      <input type="text" id="company" class="form-control" placeholder="Company Name"
                        aria-invalid="false" required>
                    </div>
                  </div>
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                    <button type="submit" class="btn btn-primary mr-sm-2 mb-1">Save Changes</button>
                    <button type="reset" class="btn btn-secondary mb-1">Cancel</button>
                  </div>
                </div>
              </form>
            </div>

            <!-- Change Password Tab -->
            <div class="tab-pane" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
              <form novalidate>
                <div class="form-group">
                  <label for="old-password">Old Password</label>
                  <div class="controls">
                    <input type="password" id="old-password" class="form-control" placeholder="Old Password" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="new-password">New Password</label>
                  <div class="controls">
                    <input type="password" id="new-password" class="form-control" placeholder="New Password" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="retype-new-password">Retype New Password</label>
                  <div class="controls">
                    <input type="password" id="retype-new-password" class="form-control" placeholder="New Password"
                      required>
                  </div>
                </div>
                <div class="d-flex flex-sm-row flex-column justify-content-end">
                  <button type="submit" class="btn btn-primary mr-sm-2 mb-1">Save Changes</button>
                  <button type="reset" class="btn btn-secondary mb-1">Cancel</button>
                </div>
              </form>
            </div>

            <!-- Info Tab -->
            <div class="tab-pane" id="info" role="tabpanel" aria-labelledby="info-tab">
              <form novalidate>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" class="form-control" placeholder="Your Bio data here..." rows="3"></textarea>
                  </div>
                  <div class="col-12 form-group">
                    <label for="bdate">Birth Date</label>
                    <div class="controls">
                      <input id="bdate" type="text" class="form-control pickadate" required placeholder="Birth date">
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <label for="country">Country</label>
                    <div class="controls">
                      <select id="country" class="form-control" required>
                        <option value="">Select Country</option>
                        <option value="USA">USA</option>
                        <option value="UK">UK</option>
                        <option value="New York">New York</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <label for="languages">Languages</label>
                    <select id="languages" class="select2 form-control" multiple aria-hidden="true">
                      <option value="English" selected>English</option>
                      <option value="Spanish">Spanish</option>
                      <option value="French">French</option>
                      <option value="Russian">Russian</option>
                      <option value="German">German</option>
                      <option value="Hindi">Hindi</option>
                      <option value="Arabic">Arabic</option>
                      <option value="Sanskrit">Sanskrit</option>
                    </select>
                  </div>
                  <div class="col-12 form-group">
                    <label for="phone">Phone</label>
                    <div class="controls">
                      <input id="phone" type="text" class="form-control" required placeholder="Phone number"
                        value="(+656) 254 2568">
                    </div>
                  </div>
                  <div class="col-12 form-group">
                    <label for="website">Website</label>
                    <input id="website" type="text" class="form-control" placeholder="Website Address">
                  </div>
                  <div class="col-12 form-group">
                    <label for="music">Favourite Music</label>
                    <select id="music" class="select2 form-control" multiple aria-hidden="true">
                      <option value="Rock">Rock</option>
                      <option value="Jazz" selected>Jazz</option>
                      <option value="Disco">Disco</option>
                      <option value="Pop">Pop</option>
                      <option value="Techno">Techno</option>
                      <option value="Folk">Folk</option>
                      <option value="Hip Hop" selected>Hip Hop</option>
                    </select>
                  </div>
                  <div class="col-12 form-group">
                    <label for="movies">Favourite Movies</label>
                    <select id="movies" class="select2 form-control" multiple aria-hidden="true">
                      <option value="Avatar">Avatar</option>
                      <option value="The Dark Knight" selected>The Dark Knight</option>
                      <option value="Harry Potter">Harry Potter</option>
                      <option value="Iron Man">Iron Man</option>
                      <option value="Spider Man">Spider Man</option>
                      <option value="Perl Harbour" selected>Perl Harbour</option>
                      <option value="Airplane!">Airplane!</option>
                    </select>
                  </div>
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                    <button type="submit" class="btn btn-primary mr-sm-2 mb-1">Save Changes</button>
                    <button type="reset" class="btn btn-secondary mb-1">Cancel</button>
                  </div>
                </div>
              </form>
            </div>

            <!-- Social Links Tab -->
            <div class="tab-pane" id="social-links" role="tabpanel" aria-labelledby="social-links-tab">
              <form novalidate>
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="twitter">Twitter</label>
                    <input id="twitter" type="text" class="form-control" placeholder="Add link"
                      value="https://www.twitter.com/">
                  </div>
                  <div class="col-12 form-group">
                    <label for="facebook">Facebook</label>
                    <input id="facebook" type="text" class="form-control" placeholder="Add link">
                  </div>
                  <div class="col-12 form-group">
                    <label for="google+">Google+</label>
                    <input id="google+" type="text" class="form-control" placeholder="Add link">
                  </div>
                  <div class="col-12 form-group">
                    <label for="linkedin">Linkedin</label>
                    <input id="linkedin" type="text" class="form-control" placeholder="Add link"
                      value="https://www.linkedin.com/">
                  </div>
                  <div class="col-12 form-group">
                    <label for="instagram">Instagram</label>
                    <input id="instagram" type="text" class="form-control" placeholder="Add link">
                  </div>
                  <div class="col-12 form-group">
                    <label for="quora">Quora</label>
                    <input id="quora" type="text" class="form-control" placeholder="Add link">
                  </div>
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                    <button type="button" class="btn btn-primary mr-sm-2 mb-1">Save Changes</button>
                    <button type="button" class="btn btn-secondary mb-1">Cancel</button>
                  </div>
                </div>
              </form>
            </div>

            <!-- Connections Tab -->
            <div class="tab-pane" id="connections" role="tabpanel" aria-labelledby="connections-tab">
              <form novalidate>
                <div class="row">
                  <div class="col-12 my-2">
                    <button type="button" class="btn btn-info">Connect to <strong>Twitter</strong></button>
                  </div>
                  <div class="col-12 my-2">
                    <button type="button" class=" btn btn-sm btn-secondary float-right">edit</button>
                    <h6>You are connected to facebook.</h6>
                    <p>johndoe@gmail.com</p>
                  </div>
                  <div class="col-12 my-2">
                    <button type="button" class="btn btn-danger">Connect to <strong>Google</strong></button>
                  </div>
                  <div class="col-12 my-2">
                    <button type="button" class=" btn btn-sm btn-secondary float-right">edit</button>
                    <h6>You are connected to Instagram.</h6>
                    <p>johndoe@gmail.com</p>
                  </div>
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                    <button type="button" class="btn btn-primary mr-sm-2 mb-1">Save changes</button>
                    <button type="button" class="btn btn-secondary mb-1">Cancel</button>
                  </div>
                </div>
              </form>
            </div>

            <!-- Notifications Tab -->
            <div class="tab-pane" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
              <div class="row">
                <h6 class="col-12 text-bold-400 pl-0">Activity</h6>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch custom-control-inline">
                    <input id="switch1" type="checkbox" class="custom-control-input" checked>
                    <label for="switch1" class="custom-control-label">Email me when someone comments on my
                      article</label>
                  </div>
                </div>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch custom-control-inline">
                    <input id="switch2" type="checkbox" class="custom-control-input" checked>
                    <label for="switch2" class="custom-control-label">Email me when someone answers on my form</label>
                  </div>
                </div>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch custom-control-inline">
                    <input id="switch3" type="checkbox" class="custom-control-input" disabled>
                    <label for="switch3" class="custom-control-label">Email me when someone follows me</label>
                  </div>
                </div>
                <h6 class="col-12 text-bold-400 pl-0 mt-3">Application</h6>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch custom-control-inline">
                    <input id="switch4" type="checkbox" class="custom-control-input" checked>
                    <label for="switch4" class="custom-control-label">News and announcements</label>
                  </div>
                </div>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch custom-control-inline">
                    <input id="switch5" type="checkbox" class="custom-control-input" disabled>
                    <label for="switch5" class="custom-control-label">Weekly product updates</label>
                  </div>
                </div>
                <div class="col-12 mb-2">
                  <div class="custom-control custom-switch custom-control-inline">
                    <input id="switch6" type="checkbox" class="custom-control-input" checked>
                    <label for="switch6" class="custom-control-label">Weekly blog digest</label>
                  </div>
                </div>
                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                  <button type="button" class="btn btn-primary mr-sm-2 mb-1">Save changes</button>
                  <button type="button" class="btn btn-secondary mb-1">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Account Settings ends -->