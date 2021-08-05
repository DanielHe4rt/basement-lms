<div class="card-header card-header-tabs card-header-rose">
    <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
            <span class="nav-tabs-title">Course Actions:</span>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'instructor-course-manage' ? 'active' : '' }}" href="{{ route('instructor-course-manage', ['course' => $course] ) }}">
                        <i class="material-icons">cloud</i> {{ trans('courses::view.navbar.landingPage') }}
                        <div class="ripple-container"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'instructor-course-curriculum' ? 'active' : '' }}" href="{{ route('instructor-course-curriculum', ['course' => $course] ) }}">
                        <i class="material-icons">assignment</i> {{ trans('courses::view.navbar.grade') }}
                        <div class="ripple-container"></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
