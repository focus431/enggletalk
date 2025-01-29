 <!-- Footer -->
 <!-- Footer -->
 <footer class="footer">
   @if (!Route::is(['map-list']))
   <!-- Footer Top -->
   <div class="footer-top">
     <div class="container-fluid">
       <div class="row">
         <div class="col-lg-3 col-md-6">

           <!-- Footer Widget -->
           <div class="footer-widget footer-about">
             <div class="footer-logo">
               <img src="/assets/img/logo.png" alt="logo">
             </div>
             <div class="footer-about-content">
               <p>{{ __('Personalized English instruction') }}</p>
             </div>
           </div>
           <!-- /Footer Widget -->

         </div>

         <div class="col-lg-3 col-md-6">

           <!-- Footer Widget -->
           <div class="footer-widget footer-menu">
             <h2 class="footer-title">{{ __('For Mentee') }}</h2>
             <ul>
               <li><a href="login">{{ __('Login') }}</a></li>
               <li><a href="mentee-register">{{ __('Register') }}</a></li>
             </ul>
           </div>
           <!-- /Footer Widget -->

         </div>

         <div class="col-lg-3 col-md-6">

           <!-- Footer Widget -->
           <div class="footer-widget footer-menu">
             <h2 class="footer-title">{{ __('For Mentors') }}</h2>
             <ul>
               <li><a href="login">{{ __('Login') }}</a></li>
               <li><a href="mentor-register">{{ __('Register') }}</a></li>
             </ul>
           </div>
           <!-- /Footer Widget -->

         </div>

         <div class="col-lg-3 col-md-6">

           <!-- Footer Widget -->
           <div class="footer-widget footer-contact">
             <h2 class="footer-title">{{ __('Contact Us') }}</h2>
             <div class="footer-contact-info">
               <div class="footer-address">
                 <span><i class="fas fa-map-marker-alt fa-lg"></i></span> <!-- 使用 fa-lg, fa-2x, fa-3x 等类名 -->
                 <p>{{ __('台北市中正區館前路8號7樓,') }}</p>
               </div>
               <div class="footer-address">
                 <span><i class="fas fa-phone fa-lg"></i></span> <!-- 使用 fa-lg, fa-2x, fa-3x 等类名 -->
                 <p>{{ __('02-7742-3836') }}</p>
               </div>
               <div class="footer-address">
                 <a href="https://line.me/R/ti/p/@992pllsd" rel="noopener" target="_blank">
                   <span><i class="fab fa-line fa-lg"></i>
                     <p>@992pllsd
                   </span>
                 </a>
               </div>



             </div>
             <!-- /Footer Widget -->

           </div>

         </div>
       </div>
     </div>
     <!-- /Footer Top -->

     <!-- Footer Bottom -->
     <div class="footer-bottom">
       <div class="container-fluid">

         <!-- Copyright -->
         <div class="copyright">
           <div class="row">
             <div class="col-12 text-center">
               <div class="copyright-text">
                 <p class="mb-0">
                   &copy; {{ date('Y') }}
                   <a href="https://gezhong.com.tw" target="_blank" title="菲律賓遊學與語言學校專家">菲律賓遊學</a>.
                   {{ __('All rights reserved.') }}
                   <span>專業菲律賓遊學與菲律賓語言學校選擇，為您打造最佳留學體驗。</span>
                 </p>
               </div>
             </div>
           </div>
         </div>


         <!-- /Copyright -->

       </div>
     </div>
     <!-- /Footer Bottom -->

 </footer>
 <!-- /Footer -->
 </div>
 @endif

 @if (Route::is(['schedule-timings']))
 <!-- Add Time Slot Modal -->
 <div class="modal fade custom-modal" id="add_time_slot">
   <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Add Time Slots</h5>
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>


       <div class="modal-body">
         <form>
           <div class="hours-info">
             <div class="row form-row hours-cont">
               <div class="col-12 col-md-10">
                 <div class="row form-row">
                   <div class="col-12 col-md-6">
                     <div class="form-group">
                       <label>Start Time</label>
                       <select class="form-control">
                         <option>Select</option>
                         <option>12.00 am</option>
                         <option>1.00 am</option>
                         <option>2.00 am</option>
                         <option>3.00 am</option>
                         <option>4.00 am</option>
                         <option>5.00 am</option>
                         <option>6.00 am</option>
                         <option>7.00 am</option>
                         <option>8.00 am</option>
                         <option>9.00 am</option>
                         <option>10.00 am</option>
                         <option>11.00 am</option>
                         <option>12.00 pm</option>
                         <option>1.00 pm</option>
                         <option>2.00 pm</option>
                         <option>3.00 pm</option>
                         <option>4.00 pm</option>
                         <option>5.00 pm</option>
                         <option>6.00 pm</option>
                         <option>7.00 pm</option>
                         <option>8.00 pm</option>
                         <option>9.00 pm</option>
                         <option>10.00 pm</option>
                         <option>11.00 pm</option>
                       </select>
                     </div>
                   </div>
                   <div class="col-12 col-md-6">
                     <div class="form-group">
                       <label>End Time</label>
                       <select class="form-control">
                         <option>Select</option>
                         <option>12.00 am</option>
                         <option>1.00 am</option>
                         <option>2.00 am</option>
                         <option>3.00 am</option>
                         <option>4.00 am</option>
                         <option>5.00 am</option>
                         <option>6.00 am</option>
                         <option>7.00 am</option>
                         <option>8.00 am</option>
                         <option>9.00 am</option>
                         <option>10.00 am</option>
                         <option>11.00 am</option>
                         <option>12.00 pm</option>
                         <option>1.00 pm</option>
                         <option>2.00 pm</option>
                         <option>3.00 pm</option>
                         <option>4.00 pm</option>
                         <option>5.00 pm</option>
                         <option>6.00 pm</option>
                         <option>7.00 pm</option>
                         <option>8.00 pm</option>
                         <option>9.00 pm</option>
                         <option>10.00 pm</option>
                         <option>11.00 pm</option>
                       </select>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>

           <div class="add-more mb-3">
             <a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
           </div>
           <div class="submit-section text-center">
             <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
 <!-- /Add Time Slot Modal -->

 <!-- Edit Time Slot Modal -->
 <div class="modal fade custom-modal" id="edit_time_slot" tabindex="-1" aria-labelledby="editModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">選擇時段</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body text-center">
         <form id="timePeriodForm">
           <div id="timeSlots">
             <div class="timeSlot row justify-content-center align-items-end">
               <div class="form-group col-md-3">
                 <label for="startTime">開始時間</label>
                 <select class="form-control startTime"></select>
               </div>
               <div class="form-group col-md-3">
                 <label for="endTime">結束時間</label>
                 <select class="form-control endTime"></select>
               </div>
               <div class="form-group col-md-3">
                 <button type="button" class="btn btn-danger removeSlot">刪除</button>
               </div>
             </div>
           </div>
           <div class="text-left mt-3">
             <button type="button" id="addSlot" class="btn btn-primary">新增更多時段</button>
           </div>
         </form>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
         <button type="button" class="btn btn-primary submit-btn" id="saveChanges">保存更改</button>
       </div>
     </div>
   </div>
 </div>

 <!-- /Edit Time Slot Modal -->
 @endif
 @if (Route::is(['profile-mentee', 'profile']))
 <!-- Voice Call Modal -->
 <div class="modal fade call-modal" id="voice_call">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-body">
         <!-- Outgoing Call -->
         <div class="call-box incoming-box">
           <div class="call-wrapper">
             <div class="call-inner">
               <div class="call-user">
                 <img alt="User Image" src="/assets/img/user/user.jpg" class="call-avatar">
                 <h4>Jonathan Doe</h4>
                 <span>Connecting...</span>
               </div>
               <div class="call-items">
                 <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal"
                   aria-label="Close"><i class="material-icons">call_end</i></a>
                 <a href="voice-call" class="btn call-item call-start"><i class="material-icons">call</i></a>
               </div>
             </div>
           </div>
         </div>
         <!-- Outgoing Call -->

       </div>
     </div>
   </div>
 </div>
 <!-- /Voice Call Modal -->

 <!-- Video Call Modal -->
 <div class="modal fade call-modal" id="video_call">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-body">

         <!-- Incoming Call -->
         <div class="call-box incoming-box">
           <div class="call-wrapper">
             <div class="call-inner">
               <div class="call-user">
                 <img class="call-avatar" src="/assets/img/user/user.jpg" alt="User Image">
                 <h4>Dr. Darren Elder</h4>
                 <span>Calling ...</span>
               </div>
               <div class="call-items">
                 <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal"
                   aria-label="Close"><i class="material-icons">call_end</i></a>
                 <a href="video-call" class="btn call-item call-start"><i class="material-icons">videocam</i></a>
               </div>
             </div>
           </div>
         </div>
         <!-- /Incoming Call -->

       </div>
     </div>
   </div>
 </div>
 <!-- Video Call Modal -->
 @endif
 @if (Route::is(['blog']))
 <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <p></p>
       </div>
       <div class="modal-footer">
         <a href="javascript:;" class="btn btn-success si_accept_confirm">Yes</a>
         <button type="button" class="btn btn-danger si_accept_cancel" data-bs-dismiss="modal">Cancel</button>
       </div>
     </div>
   </div>
 </div>
 @endif
 @if (Route::is(['chat']))
 <!-- Voice Call Modal -->
 <div class="modal fade call-modal" id="voice_call">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-body">

         <!-- Outgoing Call -->
         <div class="call-box incoming-box">
           <div class="call-wrapper">
             <div class="call-inner">
               <div class="call-user">
                 <img alt="User Image" src="assets/img/user/user.jpg" class="call-avatar">
                 <h4>Marvin Downey</h4>
                 <span>Connecting...</span>
               </div>
               <div class="call-items">
                 <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal"
                   aria-label="Close"><i class="material-icons">call_end</i></a>
                 <a href="voice-call" class="btn call-item call-start"><i class="material-icons">call</i></a>
               </div>
             </div>
           </div>
         </div>
         <!-- Outgoing Call -->

       </div>
     </div>
   </div>
 </div>
 <!-- /Voice Call Modal -->

 <!-- Video Call Modal -->
 <div class="modal fade call-modal" id="video_call">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-body">

         <!-- Incoming Call -->
         <div class="call-box incoming-box">
           <div class="call-wrapper">
             <div class="call-inner">
               <div class="call-user">
                 <img class="call-avatar" src="assets/img/user/user.jpg" alt="User Image">
                 <h4>Richard Wilson</h4>
                 <span>Calling ...</span>
               </div>
               <div class="call-items">
                 <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal"
                   aria-label="Close"><i class="material-icons">call_end</i></a>
                 <a href="video-call" class="btn call-item call-start"><i class="material-icons">videocam</i></a>
               </div>
             </div>
           </div>
         </div>
         <!-- /Incoming Call -->

       </div>
     </div>
   </div>
 </div>
 <!-- Video Call Modal -->
 @endif
 @if (Route::is(['chat-mentee']))
 <!-- Voice Call Modal -->
 <div class="modal fade call-modal" id="voice_call">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-body">

         <!-- Outgoing Call -->
         <div class="call-box incoming-box">
           <div class="call-wrapper">
             <div class="call-inner">
               <div class="call-user">
                 <img alt="User Image" src="assets/img/user/user.jpg" class="call-avatar">
                 <h4>Richard Wilson</h4>
                 <span>Connecting...</span>
               </div>
               <div class="call-items">
                 <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal"
                   aria-label="Close"><i class="material-icons">call_end</i></a>
                 <a href="voice-call" class="btn call-item call-start"><i class="material-icons">call</i></a>
               </div>
             </div>
           </div>
         </div>
         <!-- Outgoing Call -->

       </div>
     </div>
   </div>
 </div>
 <!-- /Voice Call Modal -->

 <!-- Video Call Modal -->
 <div class="modal fade call-modal" id="video_call">
   <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
       <div class="modal-body">

         <!-- Incoming Call -->
         <div class="call-box incoming-box">
           <div class="call-wrapper">
             <div class="call-inner">
               <div class="call-user">
                 <img class="call-avatar" src="assets/img/user/user.jpg" alt="User Image">
                 <h4>Richard Wilson</h4>
                 <span>Calling ...</span>
               </div>
               <div class="call-items">
                 <a href="javascript:void(0);" class="btn call-item call-end" data-bs-dismiss="modal"
                   aria-label="Close"><i class="material-icons">call_end</i></a>
                 <a href="video-call" class="btn call-item call-start"><i class="material-icons">videocam</i></a>
               </div>
             </div>
           </div>
         </div>
         <!-- /Incoming Call -->

       </div>
     </div>
   </div>
 </div>
 <!-- Video Call Modal -->
 @endif
 @if (Route::is(['appointments']))
 <!-- Appointment Details Modal -->
 <div class="modal fade custom-modal" id="appt_details">
   <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">Appointment Details</h5>
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <ul class="info-details">
           <li>
             <div class="details-header">
               <div class="row">
                 <div class="col-md-6">
                   <span class="title">#APT0001</span>
                   <span class="text">21 Oct 2019 10:00 AM</span>
                 </div>
                 <div class="col-md-6">
                   <div class="text-end">
                     <button type="button" class="btn bg-success-light btn-sm"
                       id="topup_status">Completed</button>
                   </div>
                 </div>
               </div>
             </div>
           </li>
           <li>
             <span class="title">Status:</span>
             <span class="text">Completed</span>
           </li>
           <li>
             <span class="title">Confirm Date:</span>
             <span class="text">29 Jun 2019</span>
           </li>
           <li>
             <span class="title">Paid Amount</span>
             <span class="text">$450</span>
           </li>
         </ul>
       </div>
     </div>
   </div>
 </div>
 <!-- /Appointment Details Modal -->
 @endif


 @if (Route::is(['bookings_mentee']))
 <!-- 評分 Modal -->
 <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="reviewModalLabel">提交評論</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form action="/submit-review" method="POST" id="reviewForm">
         @csrf
         <div class="modal-body">
           <input type="hidden" name="classschedule_id" id="classScheduleId">
           <input type="hidden" name="user_id" id="mentorId">
           <input type="hidden" name="mentee_id" id="menteeId">
           <div class="form-group">
             <label>Rating：</label>
             <div class="rating">
               <i class="fas fa-star" data-value="1"></i>
               <i class="fas fa-star" data-value="2"></i>
               <i class="fas fa-star" data-value="3"></i>
               <i class="fas fa-star" data-value="4"></i>
               <i class="fas fa-star" data-value="5"></i>
             </div>
             <input type="hidden" name="rating" id="ratingValue">
           </div>
           <div class="form-group">
             <label>Comment：</label>
             <textarea class="form-control" name="comment" rows="4"></textarea>
           </div>
         </div>
         <div class="modal-footer">
           <button type="button" id="closeModalButton" class="btn btn-secondary closeModalButton"
             data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Submit</button>
         </div>
       </form>


     </div>
   </div>
 </div>





 <!-- Review Modal -->
 <div class="modal fade" id="reviewDetails" tabindex="-1" role="dialog" aria-labelledby="reviewDetailsLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
     <!-- Modal 內容開始 -->
     <div class="modal-content">
       <!-- 這裡是 Modal 的主要內容 -->
       <div class="doc-review review-listing">
         <!-- Review Listing -->
         <ul class="comments-list">
           <!-- Comment List -->
           <li>
             <div class="comment">
               <img class="avatar rounded-circle" alt="User Image" src="assets/img/user/user.jpg">
               <div class="comment-body">
                 <div class="meta-data">
                   <span class="comment-author">Richard Wilson</span>
                   <span class="comment-date">Reviewed 2 Days ago</span>
                   <div class="review-count rating">
                     <i class="fas fa-star filled"></i>
                     <i class="fas fa-star filled"></i>
                     <i class="fas fa-star filled"></i>
                     <i class="fas fa-star filled"></i>
                     <i class="fas fa-star"></i>
                   </div>
                 </div>
                 <p class="recommended"><i class="far fa-thumbs-up"></i> I recommend the consectetur</p>
                 <p class="comment-content">
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                   sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                   Ut enim ad minim veniam, quis nostrud exercitation.
                   Curabitur non nulla sit amet nisl tempus
                 </p>
                 <div class="comment-reply">
                   <p class="recommend-btn">
                     <span>Recommend?</span>
                     <a href="#" class="like-btn">
                       <i class="far fa-thumbs-up"></i> Yes
                     </a>
                     <a href="#" class="dislike-btn">
                       <i class="far fa-thumbs-down"></i> No
                     </a>
                   </p>
                 </div>
               </div>
             </div>
             <!-- 略去其他評論，重複結構 -->
           </li>
           <!-- /Comment List -->
         </ul>
         <!-- /Review Listing -->
       </div>
     </div>
     <!-- Modal 內容結束 -->
   </div>
 </div>
 @endif