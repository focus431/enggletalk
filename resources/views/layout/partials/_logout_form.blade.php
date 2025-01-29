<!-- resources/views/layouts/partials/_logout_form.blade.php -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
