@extends('front.layouts.front_master')

@section('content')
<style type="text/css">
  
</style>
<!-- Page Content  -->
<div id="content" class="p-4 p-md-5">
    <div class="row">
        <div class="col-md-12">
                             
        <article class="card ml-5">
       		
          <div class="container">
            
  <div class="row">
      <div class="col-sm-12">
        
        <div class="tab-container">
          <ul class="nav nav-tabs nav-tabs-left nav-centered" role="tablist">
            <li role="presentation" class="active">
              <a href="#web-dev" data-toggle="tab" role="tab">
                Notifications
              </a>
            </li>
            <li role="presentation">
              <a href="#graphic" data-toggle="tab" role="tab">
                Account Settings
              </a>
            </li>
            <li role="presentation">
              <a href="#marketing" data-toggle="tab" role="tab">
                Payment Settings
              </a>
            </li>
            <li role="presentation">
              <a href="#business" data-toggle="tab" role="tab">
                Manage Addresses
              </a>
            </li>
            
          </ul>
          <div id="my_side_tabs" class="tab-content side-tabs side-tabs-left">
            <div class="tab-pane fade in active" id="web-dev" role="tabpanel">
              <div class="col-sm-12">
                <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" colspan="4">TYPE OF NOTIFICATION</th>
            <th scope="col">Email</th>
            <th scope="col">App</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" colspan="4">

              <h4>Your Orders</h4>
              <br>
              <p>Notify me of the status of my orders</p>

            </th>
            <td>  
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
               
              </div> 
            </td>
            <td>
                <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
               
              </div> 
            </td>

          </tr>

         <tr>
            <th scope="row" colspan="4">

              <h4>Deals and Promotions</h4>
              <br>
              <p>Daily deals, promotions, and flash sales</p>

            </th>
            <td>  
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
               
              </div> 
            </td>
            <td>  
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
               
              </div> 
            </td>

          </tr>
           <tr>
            <th scope="row" colspan="4">

              <h4>Rewards</h4>
              <br>
              <p>Gifts, rewards, and coupons</p>

            </th>
            <td>   
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
               
              </div> 
            </td>
            <td>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
          
                </div>
            </td>

          </tr>
        </tbody>
      </table>
              </div>
           
              <div class="col-sm-6">
                
              </div>
            </div>
            <div class="tab-pane fade" id="graphic" role="tabpanel">
              
                 <div class=".col-xs-4 .col-md-offset-2">
    <div class="panel panel-default panel-info Profile">
      <div class="panel-heading"><h2> Account Settings</h2> </div>
      <div class="panel-body">
        <div class="form-horizontal">
                    <form method="" action="">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="firstName"
                                    placeholder="First Name" ng-model="me.firstName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="lastName"
                                    placeholder="Last Name" ng-model="me.lastName">
                            </div>
                        </div>
                         <div class="form-group ">

                                <label class="col-sm-2 control-label">Birthday</label>
                                <div class="col-sm-8">
                                <input type="date" class="form-control" name="date"  id="birthday">
                            </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="email"
                                    placeholder="Email" ng-model="me.email">
                                    <button type="button" class="btn btn-primary float-right mt-1">Update Email</button>
                            </div>
                        </div>

                     <div class="form-group">
                      <br>
                            <label for="password" class="col-sm-2 control-label">Password</label>

                            <div class="col-sm-8">
                                <input id="password" type="password" class="form-control" name="oldpassword" placeholder="Old Password" required autocomplete="old-password"><br>
                                <input id="password" type="password" class="form-control" name="newpassword" placeholder="New Password" required autocomplete="new-password"><br>
                                <input id="password" type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required autocomplete="confirm-password">
                                <button type="button" class="btn btn-primary float-right mt-1">Update Password</button>

                            </div>
                        </div>
                                

                            </div>


                        <div class="form-group">
                          <br>
                            <label class="col-sm-3 control-label">Phone Number</label>
                            <div class="col-sm-8">
                              <label>Get Reset key to change your phone number:</label>
                                <input class="form-control" type="text" name="phone"
                                    placeholder="xxx-xxx-xxxx" ng-model="me.email">
                                    <button type="button" class="btn btn-primary float-right mt-1">Get Reset Key</button>
                                    <br>
                            </div>
                        </div> 

                        <div class="form-group">
                          <br>
                           <label class="col-sm-3 control-label">Country</label>
                         <select id="favcity" name="select" style="height: 40px;width: 30%;">
                            <option value="0">Bangladesh</option>
                            <option value="1">Pakistan</option>
                            <option value="2">Chaina</option>
                            <option value="3">India</option>
                            <option value="4">Hong Kong</option>
                            <option value="5">UK</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <br>
                           <label class="col-sm-3 control-label">Language</label>
                         <select id="favcity" name="select" style="height: 40px;width: 30%;">
                            <option value="0">Bangladesh</option>
                            <option value="1">Hindi</option>
                            <option value="2">Chaines</option>
                            <option value="4">Urdu</option>
                            <option value="5">English</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <br>
                           <label class="col-sm-3 control-label">Currency</label>
                         <select id="favcity" name="select" style="height: 40px;width: 30%;">
                            <option value="0">TK BDT</option>
                            <option value="1">$ USD</option>
                            <option value="2">$ EUR</option>

                          </select>
                        </div>     

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-primary float-right" ng-click="updateMe()">Update</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end form-horizontal -->
      </div> <!-- end panel-body -->

    </div> <!-- end panel -->
    

  </div>
                          
            </div>
            <div class="tab-pane fade" id="marketing" role="tabpanel">
          <div class="col-sm-12">
                <h3>Payment Settings</h3>
                 <div class="form-group">
                    <br>
                      <label class="col-sm-3 control-label">Shipping Details</label>
                        <div class="col-sm-8">
                          <input class="form-control" type="text" name="" 
                          ng-model="me.email" placeholder="Add Shipping Details at Checkout" readonly>

                        </div>
                  </div> 
                  <div class="form-group">
                      <label class="col-sm-4 control-label">Billing Details</label>
                        <div class="col-sm-8">
                          <input class="form-control" type="text" name="" 
                          ng-model="me.email" placeholder="Add Billing Details at Checkout" readonly>
                            
                            <br>
                        </div>
                  </div>  
                
              </div>
    
            </div>
            <div class="tab-pane fade" id="business" role="tabpanel">
              <div class="col-sm-12">
                <form method="" action="">
                <h3>Manage Addresses</h3>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                            <label class="col-sm-4 control-label">First Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="firstName"
                                    placeholder="First Name" ng-model="me.firstName">
                            </div>
                        </div>
                     
                  </div>
                  <div class="col-sm-6">
                       <div class="form-group">
                            <label class="col-sm-4 control-label">Last Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="lastName"
                                    placeholder="Last Name" ng-model="me.lastName">
                            </div>
                        </div>
                  </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-4 control-label">Address 1</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="address1" placeholder="Address 1" ng-model="me.lastName">
                        </div>
                  </div>
                 <div class="form-group">
                    <label class="col-sm-4 control-label">Address 2</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="address2" placeholder="Address 2" ng-model="me.lastName">
                        </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Phone</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" name="phone" placeholder="Phone Number" ng-model="me.lastName">
                        </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                            <label class="col-sm-4 control-label">Country</label>
                            <div class="col-sm-8">
                                <select id="favcity" name="select" style="height: 40px;width: 90%;">
                                  <option value="0">Bangladesh</option>
                                  <option value="1">India</option>
                                  <option value="2">Pakistan</option>
                                </select>
                            </div>
                        </div>
                     
                  </div>
                  <div class="col-sm-6">
                       <div class="form-group">
                            <label class="col-sm-4 control-label">State</label>
                            <div class="col-sm-8">
                              <select id="favcity" name="select" style="height: 40px;width: 97%;">
                                <option value="0">Dhaka</option>
                                <option value="1">Mumbai</option>
                                <option value="2">Korachi</option>
                              </select>
                            </div>
                        </div>
                  </div>
                </div>
               <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                            <label class="col-sm-4 control-label">Country</label>
                            <div class="col-sm-8">
                                <select id="favcity" name="select" style="height: 40px;width: 90%;">
                                  <option value="0">Bangladesh</option>
                                  <option value="1">India</option>
                                  <option value="2">Pakistan</option>
                                </select>
                            </div>
                        </div>
                     
                  </div>
                  <div class="col-sm-6">
                       <div class="form-group">
                            <label class="col-sm-4 control-label">State</label>
                            <div class="col-sm-8">
                              <select id="favcity" name="select" style="height: 40px;width: 97%;">
                                <option value="0">Dhaka</option>
                                <option value="1">Mumbai</option>
                                <option value="2">Korachi</option>
                              </select>
                            </div>
                        </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                    <label class="col-sm-4 control-label">City</label>
                      <div class="col-sm-8">
                        <input class="form-control" type="text" name="city" placeholder="City" ng-model="me.lastName">
                        </div>
                  </div>
                     
                  </div>
                  <div class="col-sm-6">
                       <div class="form-group">
                    <label class="col-sm-6 control-label">Zip/Postal Code</label>
                      <div class="col-sm-8">
                        <input class="form-control" type="text" name="zip" placeholder="Zip" ng-model="me.lastName">
                        </div>
                  </div>
                  </div>
                  <div class="col-sm-offset-2 col-sm-10">
                      <button class="btn btn-primary float-right" ng-click="">Update</button>
                  </div>
                </div>

                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
          
        
        </article>
</div>
</div>

@endsection
