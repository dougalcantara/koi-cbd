<?php
/* Template Name: 2019 Veteran Signup Page */

if (!defined('ABSPATH')) {
	exit;
}

get_header();

echo k_hero(array(
  'headline' => 'Koi CBD Veteran Program',
  'body' => 'Our way of thanking all those who have served.',
));
?>

<section class="k-introtext k-block k-block--md">
  <div class="k-inner k-inner--sm k-rte-content">
    <h2 class="k-headline k-headline--sm">We Honor Those Who Serve & Have Served</h2>
    <p>At Koi, we are grateful for those who’ve served as members of the United States military. We’d like to extend a special lifelong discount program as our way of thanking you for your service to our country. By signing up below you’ll be given access to a special account that automatically applies a 25% to discount to every order you place.</p>
    <p>Use the form below to upload a copy of your VA card, State issued Drivers license or ID which shows your Veteran designation or your most recent “LES” (Military Pay Stub) for active duty.</p>
  </div>
</section>

<section class="k-veterans k-block k-block--md k-no-padding--top">
  <div class="k-inner k-inner--sm">
  
    <form class="k-veterans__forms" id="k-veteran-signup">

      <div class="k-veterans__form k-form">
        <div class="k-liner">

          <div class="k-veterans__heading">
            <div class="k-liner">
              <h3>Personal Details</h3>
            </div>
          </div>
          <div class="k-veterans__fields">
            <div class="k-form__group">
              <input type="text" class="k-input" id="k-veterans-firstname" />
              <label for="k-veterans-firstname">First Name</label>
            </div>
            <div class="k-form__group">
              <input type="text" class="k-input" id="k-veterans-lastname" />
              <label for="k-veterans-lastname">Last Name</label>
            </div>
            <div class="k-form__group">
              <input type="email" class="k-input" id="k-veterans-email" />
              <label for="k-veterans-email">Email Address</label>
            </div>
            <div class="k-form__group">
              <input type="text" class="k-input" id="k-veterans-username" />
              <label for="k-veterans-username">Username</label>
            </div>
            <div class="k-form__group">
              <input type="password" class="k-input" id="k-veterans-password" />
              <label for="k-veterans-password">Password</label>
            </div>
            <div class="k-form__group">
              <input type="password" class="k-input" id="k-veterans-password--confirm" />
              <label for="k-veterans-password--confirm">Confirm Password</label>
            </div>
          </div>
        </div>
      </div>

      <div class="k-veterans__form k-form">
        <div class="k-liner">

          <div class="k-veterans__heading">
            <div class="k-liner">
              <h3>Other Information</h3>
            </div>
          </div>
          <div class="k-veterans__fields">
            <div class="k-form__group">
              <div class="k-form__sectiontitle">
                <p>Have You Tried Koi CBD's Products Before?</p>
              </div>
              <div class="k-form__radiobutton k-has-tried">
                <input type="radio" name="has-tried-koi" value="Yes" id="k-veterans-hastried--yes">
                <label for="k-veterans-hastried--yes">Yes</label>
              </div>
              <div class="k-form__radiobutton">
                <input type="radio" name="has-tried-koi" value="No" id="k-veterans-hastried--no">
                <label for="k-veterans-hastried--no">No</label>
              </div>
            </div>
            <div class="k-form__group">
              <div class="k-form__sectiontitle">
                <p>Upload Military ID, VA Pay Stub, or Honorable/Medical Discharge paperwork</p>
              </div>
              <div class="k-form__fileupload">
                <input type="file" class="k-input" id="k-veterans-paperwork" name="veteran-paperwork" />
                <label for="k-veterans-paperwork">Upload A File</label>
                <script type="text/javascript">
                  (function() {
                    var uploader = document.querySelector('#k-veterans-paperwork');
                    var interval;

                    interval = setInterval(function() {
                      if (uploader.value) {
                        clearInterval(interval);
                        uploader.classList.add('has-value');
                      }
                    }, 50);
                  })();
                </script>
              </div>
            </div>
            <div class="k-form__group">
              <div class="k-form__sectiontitle">
                <p>How Did You Hear About Us?</p>
              </div>
              <select name="k-referred-by" id="k-veterans-referral">
                <option value="">Select One</option>
                <option value="Online/Search Engines">Online / Search Engines</option>
                <option value="Social Media">Social Media</option>
                <option value="Word of Mouth">Word of Mouth</option>
                <option value="Local Retail">Local Retail</option>
                <option value="Trade Show">Trade Show</option>
                <option value="TV">TV</option>
                <option value="Magazine Ad">Magazine Ad</option>
                <option value="Other">Other</option>
              </select>
            </div>

            <div class="k-form__actions">
              <button type="submit" class="k-button k-button--primary">Submit Application</button>
            </div>
          </div>
        </div>
      </div>

    </form>
  </div>
</section>

<?php
get_footer();
?>