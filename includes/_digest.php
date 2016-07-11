<? /*<div class="four-col box box-highlight box-digest">
  <script>
  function fieldValidate(field) {
    return true;
  }
  function getRequiredFieldMessage(domElement, label) {
    return "This field is required";
  }
  function getTelephoneInvalidMessage(domElement, label) {
    return "Please enter a valid telephone number";
  }
  function getEmailInvalidMessage(domElement, label) {
    return "Please enter a valid email address";
  }
  </script>

  <form class='mktoForm mktoNoJS' action='https://pages.canonical.com/index.php/leadCapture/save' method='post'>
    <h2>Sign up for email updates</h2>
    <p>Choose the topics you're interested in</p>
    <?php
      $term_list = wp_get_post_terms($post->ID, 'group', array("fields" => "slugs"));
      $termsString = $term_list;
      $current_tax = basename(get_permalink());
      $cs = 'cloud-and-server';
      $desktop = 'desktop';
      $pt = 'phone-and-tablet';
      $iot = 'internet-of-things';
    ?>


    <ul class='mktoFormRow clearfix'>
      <li>
        <ul class="no-bullets">
          <li>
            <input class="mktoLogicalField mktoCheckboxList mktoHasWidth" type="checkbox" id="insightscloudserver" name="insightscloudserver" value="yes"<?php if(in_array($cs, $termsString) or $current_tax == $cs or is_home() or is_page_template( 'page-press.php' )) echo ' checked="checked" ' ?>/>
            <label for="insightscloudserver">Cloud and server</label>
          </li>
          <li>
            <input class="mktoLogicalField mktoCheckboxList mktoHasWidth" type="checkbox" id="insightsdesktop" name="insightsdesktop" value="yes"<?php if(in_array($desktop, $termsString) or $current_tax == $desktop or is_home() or is_page_template( 'page-press.php' )) echo ' checked="checked" ' ?>/>
            <label for="insightsdesktop">Desktop</label>
          </li>
          <li>
            <input class="mktoLogicalField mktoCheckboxList mktoHasWidth" type="checkbox" id="insightsphonetablet" name="insightsphonetablet" value="yes"<?php if(in_array($pt, $termsString) or $current_tax == $pt or is_home() or is_page_template( 'page-press.php' )) echo ' checked="checked" ' ?>/>
            <label for="insightsphonetablet">Phone and tablet</label>
          </li>
          <li>
            <input class="mktoLogicalField mktoCheckboxList mktoHasWidth" type="checkbox" id="insightsiot" name="insightsiot" value="yes"<?php if(in_array('internet-of-things', $termsString) or $current_tax == 'internet-of-things' or is_home() or is_page_template( 'page-press.php' )) echo ' checked="checked" ' ?>/>
            <label for="insightsiot">Internet of Things</label>
          </li>
        </ul>
      </li>
      <li class='mktoFormCol'>
        <label class="off-left mktoLabel" for='Email'>Your email</label>
        <input type="text" placeholder="Your email" class='mktoField mktoTextField' name='Email' id='Email' required>
      </li>

      <li class="mktField mktLblRight">
        <span class="mktInput mktLblRight"><input class="mktFormCheckbox" name="NewsletterOpt-In" id="NewsletterOpt-In" value="yes" tabindex="9" type="checkbox" /><label>I would like to receive occasional updates from Canonical by email.</label>&nbsp;<span class="mktFormMsg"></span></span>
      </li>

      <li>
        <span style="display:none;"><input type="text" name="_marketo_comments" value=""></span>
        <span class='mktoButtonWrap'><button type='submit' class='mktoButton'>Subscribe now</button></span>

        <input value="1959" class="mktoField mktoFieldDescriptor" name="lpId" type="hidden">
        <input value="30" class="mktoField mktoFieldDescriptor" name="subId" type="hidden">
        <input type="hidden" name="lpurl" value="https://pages.canonical.com/Insights-Subscription_Insights-Subscription-test.html?cr={creative}&amp;kw={keyword}" />
        <input value="1212" class="mktoField mktoFieldDescriptor" name="formid" type="hidden">
        <input type="hidden" name="ret" value="<?php $theurl = rtrim(get_permalink(),'/'); echo $theurl; ?>?digest=true" />
        <input value="066-EOV-335" class="mktoField mktoFieldDescriptor" name="munchkinId" type="hidden">
        <input type="hidden" name="kw" value=""/>
        <input type="hidden" name="cr" value=""/>
        <input type="hidden" name="searchstr" value=""/>
        <input type="hidden" name="_mkt_disp" value="return"/>
        <input type="hidden" name="_mkt_trk" value=""/>
      </li>
    </ul>
  </form>
</div>

<script language="JavaScript" src="https://app.marketo.com/js/public/jquery-latest.min.js" type="text/javascript"></script>*/ ?>
