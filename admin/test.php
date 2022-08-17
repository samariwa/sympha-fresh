<!doctype html>
<html ⚡4email data-css-strict>
<head>
   <meta charset="utf-8">
<script async src="https://cdn.ampproject.org/v0.js"></script>

   <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>

   <style amp4email-boilerplate>body{visibility:hidden}</style>
   <style amp-custom>
       /* Fonts */
       .title {
           font: Bold 28px Arial;
           color: #212121
       }
       .subtitle {
           font: Normal 16px Arial;
           color: #444444
       }
       .note{
           font: Bold 16px Arial;
           color: #444444
       }
       .header-1 {
           font: Bold 20px Arial;
           color: #444444
       }
       .header-2 {
           font: Bold 14px Arial;
           color: #212121
       }
       .normal {
           font: Normal 14px Arial;
           color: #666666
       }
       .normal-2 {
           font: Normal 14px Arial;
           color: #444444
       }
       .error {
           font: Bold 14px Arial;
           color: #f86567
       }
       .hyperlink {
           font: Bold 14px Arial;
           color: #2E6EDF;
           text-decoration: none
       }
       /* Frames */
       .outer-frame {
           margin: 0 auto;
           width:100%;
           max-width:600px;
           background-color:#ffffff;
           border:1px solid #eeeeee;
           border-radius:4px
       }
       .inner-frame {
           padding:40px 40px
       }
       /* Form */
       .card-body {
           border: 1px solid #cccccc;
           border-radius:4px
       }
       .card-container {
           cursor: pointer;
           display: table;
           margin: 13px
       }
       .card-radio-wrapper{
           display: table-cell;
           vertical-align: middle;
           width: 52px
       }
       .card-content-wrapper {
           display: table-cell;
           vertical-align: middle
       }
       .option-container {
           cursor: pointer;
           display: table
       }
       .option-radio-wrapper {
           display: table-cell;
           vertical-align: middle;
           width: 36px
       }
       .option-content-wrapper {
           display: table-cell;
           vertical-align: middle
       }
       .checkmark {
           height: 20px;
           width: 20px;
           border-radius: 50%
       }
       .submit-wrapper {
           height: 48px;
           position: relative;
       }
       .submit-button {
           padding:14px 28px;
           height: 48px;
           border-radius:4px;
           border: 0px;
           background-color:#333333;
           font: Bold 18px Arial;
           color:#ffffff;
           cursor: pointer;
           position: absolute;
           z-index: 1
       }
       .success-msg {
           background: #f9fdfa;
           width: 100%;
           border-radius: 4px;
           position: absolute;
           border-left: 4px solid #66cc80;
           z-index: 2
       }
       .success-msg-container {
           display: table;
           margin: 10px 15px 10px 15px;
       }
       .success-msg-check {
           display: table-cell;
           vertical-align: middle;
           width: 36px
       }
       .success-msg-text {
           display: table-cell;
           vertical-align: middle
       }
       .error-msg {
           background: #fff9f9;
           width: 100%;
           border-radius: 4px;
           border-left: 4px solid #f86567;
           z-index: 2;
           padding: 1px;
       }
       .error-msg-container {
           display: table;
           margin: 8px 15px 8px 15px;
       }
       .error-msg-check {
           display: table-cell;
           vertical-align: middle;
           width: 36px
       }
       .error-msg-text {
           display: table-cell;
           vertical-align: middle;
       }
       /* Footer */
       .footer {
           border-top: 1px solid #EEEEEE;
           padding: 32px 0px;
           max-width:500px;
           margin: 0 auto;
           box-sizing: border-box;
           margin-top: 40px;
       }
       .footer-item {
           width: 33%;
           text-align:center
       }
       .footer-item > a {
           white-space:nowrap;
           font:Normal 12px/14px Arial;
           color: #AAAAAA;
           letter-spacing: 0;
           text-decoration: none
       }
       .footer-bottom {
           text-align: center;
           margin-top: 24px;
           color: #AAAAAA;
           font: Normal 12px/20px Arial;
       }
   </style>
</head>
<body>
<div class="outer-frame">
   <div class="inner-frame">
       <!-- Header -->
       <div>
           <span><amp-img src="https://i.postimg.cc/cH4yGtjc/Turing-logo.png" width="56px" height="19px" alt="turing_logo"></img></span>
           <div class="subtitle" style="margin-top:40px">Hi Samuel,</div>
           <div class="subtitle" style="margin-top:40px">I hope you’re keeping well.
           </div>
           <div class="subtitle" style="margin-top:40px">I’m AIME, the AI Matching Engine at Turing. I noticed that you updated your availability 15 days ago, just wanted to give you a heads up that this refreshes every 30 days (just 15 days to go until your current update expires). 
           </div>
<div class="subtitle" style="margin-top:40px">But don’t worry, just answer the questions below and I’ll update your Turing profile in my system the moment you click submit! 
           </div>
           <div class="subtitle" style="margin-top:40px">
           </div>
           <div class="subtitle" style="margin-top:40px"><span class="note">Please note:</span> This status update helps us know if you’re currently seeking remote job opportunities with leading U.S. companies or not. We have been getting a lot of requirements of late, and I tend to give slight preference to candidates who update their profiles regularly.
           </div>
       </div>
       <!-- Form -->
       <form style="margin:0" method="get" action-xhr="https://developers.turing.com/api/api-provider/set-availability">
           <input type="hidden" name="token" value=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjY1NDQwMCwibGFuZGluZyI6dHJ1ZSwiZW1haWwiOiJzYW11ZWxtYXJpd2FAZ21haWwuY29tIiwicm9sZV9pZCI6MywibmFtZSI6IlNhbXVlbCBNYXJpd2EiLCJpYXQiOjE2NjAwOTQ1NjcsImV4cCI6MTY2NTI3ODU2N30.ojZL1NvqokLPQT71xNWF1ej05svLnnLI5phPBhu_SVU>
           <!-- Question 1 -->
           <div>
               <div style="margin-top:48px"><span class="header-1">Are you actively looking for a remote job?</span></div>
               <div class="radio-group" style="margin-top:24px">
                   <div class="card-body">
                       <label class="card-container">
                         <span class="card-radio-wrapper">
                            <input class="checkmark" type="radio" name="response" value="1" required>
                         </span>
                           <span class="card-content-wrapper">
                            <div>
                               <div>
                                  <span style="vertical-align:middle"><amp-img src="https://i.postimg.cc/RhWd6gnw/Group-4802-2x.png" width="26px" height="24px" alt="ready_to_interview"></span>
                                  <span class="header-2">Ready to interview</span>
                               </div>
                               <div class="normal" style="margin-top:4px" >I am actively looking for a new remote software job. Mark me available to interview for the next 30 days.</div>
                            </div>
                         </span>
                       </label>
                   </div>
                   <div class="card-body" style="margin-top:8px">
                       <label class="card-container">
                         <span class="card-radio-wrapper">
                            <input class="checkmark" type="radio" name="response" value="2" required>
                         </span>
                           <span class="card-content-wrapper">
                            <div>
                               <div>
                                  <span style="vertical-align:middle"><amp-img src="https://i.postimg.cc/y84jxX6S/Group-4801-2x.png" width="26px" height="24px" alt="open_to_offers"></span>
                                  <span class="header-2">Open to Offers</span>
                               </div>
                               <div class="normal" style="margin-top:4px" >I am not actively looking for a new remote software job, but I am available to hear about new job opportunities for the next 30 days.</div>
                            </div>
                         </span>
                       </label>
                   </div>
                   <div class="card-body" style="margin-top:8px">
                       <label class="card-container">
                         <span class="card-radio-wrapper">
                            <input class="checkmark" type="radio" name="response" value="3" required>
                         </span>
                           <span class="card-content-wrapper">
                            <div>
                               <div>
                                  <span style="vertical-align:middle"><amp-img src="https://i.postimg.cc/Pxxz9Sy0/Group-4803-2x.png" width="26px" height="24px" alt="unavailabe_for_jobs"></span>
                                  <span class="header-2">Unavailable for Jobs</span>
                               </div>
                               <div class="normal" style="margin-top:4px" >I am not looking for a new remote software job at the moment.</div>
                            </div>
                         </span>
                       </label>
                   </div>
               </div>
           </div>
           <!-- Question 2 -->
           <div>
               <div style="margin-top:40px"><span class="header-1">Are you interested in full-time work (8hrs/day, 40hrs/week)?</span></div>
               <div style="margin-top:16px;">
                   <label class="option-container">
                   <span class="option-radio-wrapper">
                       <input class="checkmark" type="radio" name="availabilityStatusId" value="3" required>
                   </span>
                       <span class="option-content-wrapper normal-2">Yes</span>
                   </label>
               </div>
               <div style="margin-top:16px;">
                   <label class="option-container">
                   <span class="option-radio-wrapper">
                       <input class="checkmark" type="radio" name="availabilityStatusId" value="2" required>
                   </span>
                       <span class="option-content-wrapper normal-2">No, only part-time</span>
                   </label>
               </div>
               <div style="margin-top:16px;">
                   <label class="option-container">
                   <span class="option-radio-wrapper">
                       <input class="checkmark" type="radio" name="availabilityStatusId" value="6" required>
                   </span>
                       <span class="option-content-wrapper normal-2">I can start part-time immediately and then switch to full-time within a month</span>
                   </label>
               </div>
           </div>
           <!-- Question 3 -->
           <div>
               <div style="margin-top:40px"><span class="header-1">If you get an offer, how soon can you start working with Turing?</span></div>
               <div style="margin-top:16px;">
                   <label class="option-container">
                   <span class="option-radio-wrapper">
                       <input class="checkmark" type="radio" name="startsInWeeks" value="0" required>
                   </span>
                       <span class="option-content-wrapper normal-2">Immediately</span>
                   </label>
               </div>
               <div style="margin-top:16px;">
                   <label class="option-container">
                   <span class="option-radio-wrapper">
                       <input class="checkmark" type="radio" name="startsInWeeks" value="1" required>
                   </span>
                       <span class="option-content-wrapper normal-2">In 1 week</span>
                   </label>
               </div>
               <div style="margin-top:16px;">
                   <label class="option-container">
                   <span class="option-radio-wrapper" style="margin-right:12px;">
                       <input class="checkmark" type="radio" name="startsInWeeks" value="2" required>
                   </span>
                       <span class="option-content-wrapper normal-2">In 2 weeks</span>
                   </label>
               </div>
               <div style="margin-top:16px;">
                   <label class="option-container">
                   <span class="option-radio-wrapper">
                       <input class="checkmark" type="radio" name="startsInWeeks" value="3" required>
                   </span>
                       <span class="option-content-wrapper normal-2">In 3 weeks</span>
                   </label>
               </div>
               <div style="margin-top:16px;">
                   <label class="option-container">
                   <span class="option-radio-wrapper" style="margin-right:12px;">
                       <input class="checkmark" type="radio" name="startsInWeeks" value="4" required>
                   </span>
                       <span class="option-content-wrapper normal-2">In 1 month</span>
                   </label>
               </div>
               <div style="margin-top:16px;">
                   <label class="option-container">
                   <span class="option-radio-wrapper">
                       <input class="checkmark" type="radio" name="startsInWeeks" value="6" required>
                   </span>
                       <span class="option-content-wrapper normal-2">In more than 1 month</span>
                   </label>
               </div>
           </div>
           <div class="submit-wrapper" style="margin-top:48px">

                <input class="submit-button" type="submit" value="Submit"></input>

                <div class="success-msg">

                    <div class="success-msg-container" submit-success>

                        <span class="success-msg-check"><amp-img src="https://i.postimg.cc/J4HcMxgZ/check-circle-24px-4-2x.png" width="24px" height="24px" alt="Icon"></span>

                        <span class="header-2 success-msg-text">Thanks! Your availability was updated successfully.</span>

                    </div>

                </div>

             </div>

             <!-- Try again message -->

             <div class="error-msg" style="margin-top:24px" submit-error>

               <div class="error-msg-container">

                    <span class="error-msg-check"><amp-img src="https://i.postimg.cc/QNzM59kJ/check-circle-24px-4-2x.png" width="24px" height="24px" alt="Icon"></span>

                    <span class="error error-msg-text">Oops. Something went wrong. Please try again.</span>

               </div>

             </div>
       <input type="hidden" name="auto_email_id" value="6527a260-1d32-11ed-82a1-3dadfddea9d7"/></form>
       <div class="subtitle" style="margin-top:40px">
       </div>
       <div class="subtitle" style="margin-top:40px">
       </div>
       <div class="subtitle" style="margin-top:40px">
           <p>All the best,<br />
               Aime<br/>
               AI Matching Engine at Turing</p>

       </div>
       <!-- Plan b form -->
       <div class="normal" style="margin-top:24px">Having trouble viewing or submitting this form? <a class="hyperlink" href="https://mail.turing.com/api/analytics?hasV=y&ti=6f7a7569bb17ef637bd9e0909b4482870d660182821516c158fbca8bb713451f345530de5327e34ae308de5124bba90e7e8cf0f9297253e29f5fe26a3ce67e4ef49158b04ae827c973b230506a6b6323bc082ce10457ff385e5369e7d20dd01b2d5d8c93c981721801edfbcc09120dd67c8bca010dc8477918e4&rd=https%3A%2F%2Fdevelopers.turing.com%2Fdashboard%2Fhome%3Ftoken%3DeyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1aWQiOjY1NDQwMCwibGFuZGluZyI6dHJ1ZSwiZW1haWwiOiJzYW11ZWxtYXJpd2FAZ21haWwuY29tIiwicm9sZV9pZCI6MywibmFtZSI6IlNhbXVlbCBNYXJpd2EiLCJpYXQiOjE2NjAwOTQ1NjcsImV4cCI6MTY2NTI3ODU2N30.ojZL1NvqokLPQT71xNWF1ej05svLnnLI5phPBhu_SVU">Fill out at turing.com</a></div>
       </div>
    </div>
    <!-- Footer -->
    <div class="footer">
           <table style="width: 100%;">
               <tr>
                   <td class="footer-item">
                       <a href="https://mail.turing.com/api/analytics?ti=6f7a7569bb17ef637bd9e0909b4482870d660182821516c158fbca8bb713451f345530de5327e34ae308de5124bba90e7e8cf0f9297253e29f5fe26a3ce67e4ef49158b04ae827c973b230506a6b6323bc082ce10457ff385e5369e7d20dd01b2d5d8c93c981721801edfbcc09120dd67c8bca010dc8477918e4&rd=https%3A%2F%2Fturing.com%2Fprivacy-policy%2F">Privacy Policy</a>
                   </td>
                   <td class="footer-item">
                       <a href="https://mail.turing.com/api/analytics?ti=6f7a7569bb17ef637bd9e0909b4482870d660182821516c158fbca8bb713451f345530de5327e34ae308de5124bba90e7e8cf0f9297253e29f5fe26a3ce67e4ef49158b04ae827c973b230506a6b6323bc082ce10457ff385e5369e7d20dd01b2d5d8c93c981721801edfbcc09120dd67c8bca010dc8477918e4&rd=https%3A%2F%2Fmail.turing.com%2Fpause">Pause Emails</a>
                   </td>
                   <td class="footer-item">
                       <a href="https://mail.turing.com/api/analytics?ti=6f7a7569bb17ef637bd9e0909b4482870d660182821516c158fbca8bb713451f345530de5327e34ae308de5124bba90e7e8cf0f9297253e29f5fe26a3ce67e4ef49158b04ae827c973b230506a6b6323bc082ce10457ff385e5369e7d20dd01b2d5d8c93c981721801edfbcc09120dd67c8bca010dc8477918e4&rd=https%3A%2F%2Fturing.com%2Fterms-of-service%2F" style="margin: 0">Terms of Service</a>
                   </td>
               </tr>
           </table>
           <div class="footer-bottom">
               © 2021 Turing Enterprises, Inc <br />1900 Embarcadero Road, Palo Alto, CA 94303
           </div>
       </div>
<amp-img alt='.' src=https://mail.turing.com/api/analytics/open/6f7a7569bb17ef637bd9e0909b4482870d660182821516c158fbca8bb713451f345530de5327e34ae308de5124bba90e7e8cf0f9297253e29f5fe26a3ce67e4ef49158b04ae827c973b230506a6b6323bc082ce10457ff385e5369e7d20dd01b2d5d8c93c981721801edfbcc09120dd67c8bca010dc8477918e4 height='1' width='1'/> <p style='text-align: center'> Please use this link to <a href = 'https://mail.turing.com/api/unsubscribe?ui=afb7c807570ed26fcdbaaac8ae519766156467b638c48f42f4b96f9e568d3b129e396bf81618bd6b0f073e30b497f285452986b89c77a6e4393717a6d1b6bf083bbe36ac32c0cb356f3fb743a46059385fa44893654745bead300b01fd656ab6916684df56a0b9abdacdf66a75dd988355b73748890e42' style = 'color: #777777'>unsubscribe</a> from all our emails.</p></body>
</html>