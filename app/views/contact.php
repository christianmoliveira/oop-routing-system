<?php $this->layout('master', ['title' => 'Contact Form']) ?>

<h2>Contact</h2>

<form action="/contact" method="POST">
  <input type="text" name="subject">
  <input type="email" name="email">

  <button type="submit">Save</button>
</form>