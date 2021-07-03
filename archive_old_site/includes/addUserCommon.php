<p>
<label for="firstname">Given Name<span class="req">*</span></label>
<input id="firstname<?php echo $userType; ?>" name="firstname" type="text" class="input" />
</p><p>
<label for="lastname">Surname<span class="req">*</span></label>
<input id="lastname<?php echo $userType; ?>" name="lastname" type="text" class="input" />
</p><p>
<label for="email">Email<?php if ($userType != 'Mentee') { ?><span class="req">*</span><?php } ?></label>
<input id="email<?php echo $userType; ?>" name="email" type="text" class="input" />
</p><p>
<label for="password">Password<?php if ($userType != 'Mentee') { ?><span class="req">*</span><?php } ?></label>
<input id="password<?php echo $userType; ?>" name="password" type="password" class="input" />
</p><p>
<label for="password2">Re-Enter Password<?php if ($userType != 'Mentee') { ?><span class="req">*</span><?php } ?></label>
<input id="password2<?php echo $userType; ?>" name="password2" type="password" class="input" />
</p><p>
<label for="phone">Phone Number</label>
<input id="phone<?php echo $userType; ?>" type="text" name="phone" class="input" />
</p><p>
<label for="cphone">Cell Phone</label>
<input id="cphone<?php echo $userType; ?>" type="text" name="cphone" class="input" />
</p>