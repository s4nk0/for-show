<div class="d-flex mb-4 pb-4 border-bottom">
    <div class="user-block__icon">
        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.2941 0H2.25859C1.87849 0 1.5705 0.308078 1.5705 0.688083V4.65594H0.706638C0.326541 4.65594 0.0185547 4.96401 0.0185547 5.34402C0.0185547 5.72402 0.326541 6.0321 0.706638 6.0321H1.5705V9.31196H0.706638C0.326541 9.31196 0.0185547 9.62004 0.0185547 10C0.0185547 10.3801 0.326541 10.6881 0.706638 10.6881H1.5705V13.9679H0.706638C0.326541 13.9679 0.0185547 14.276 0.0185547 14.656C0.0185547 15.036 0.326541 15.3441 0.706638 15.3441H1.5705V19.3119C1.5705 19.6919 1.87849 20 2.25859 20H17.2942C17.6743 20 17.9823 19.6919 17.9823 19.3119V0.688083C17.9822 0.308078 17.6742 0 17.2941 0ZM16.606 18.6238H2.94667V15.3441H3.81053C4.19063 15.3441 4.49862 15.036 4.49862 14.656C4.49862 14.276 4.19063 13.9679 3.81053 13.9679H2.94667V10.6881H3.81053C4.19063 10.6881 4.49862 10.3801 4.49862 10C4.49862 9.62004 4.19063 9.31196 3.81053 9.31196H2.94667V6.0321H3.81053C4.19063 6.0321 4.49862 5.72402 4.49862 5.34402C4.49862 4.96401 4.19063 4.65594 3.81053 4.65594H2.94667V1.37617H16.6061V18.6238H16.606Z" fill="black"/>
            <path d="M10.2685 10.3163C11.8285 10.3163 13.0977 9.04665 13.0977 7.48608C13.0977 5.92541 11.8285 4.65576 10.2685 4.65576C8.70803 4.65576 7.43848 5.92541 7.43848 7.48608C7.43848 9.04665 8.70803 10.3163 10.2685 10.3163ZM10.2685 6.03202C11.0697 6.03202 11.7216 6.68432 11.7216 7.48617C11.7216 8.28792 11.0698 8.94022 10.2685 8.94022C9.46685 8.94022 8.81464 8.28792 8.81464 7.48617C8.81464 6.68432 9.46685 6.03202 10.2685 6.03202Z" fill="black"/>
            <path d="M7.11875 15.4628C7.49884 15.4628 7.80683 15.1547 7.80683 14.7747V13.5856C7.80683 12.8224 8.42794 12.2014 9.19125 12.2014H11.3639C12.1273 12.2014 12.7484 12.8223 12.7484 13.5856V14.7747C12.7484 15.1547 13.0563 15.4628 13.4364 15.4628C13.8164 15.4628 14.1245 15.1547 14.1245 14.7747V13.5856C14.1245 12.0636 12.8862 10.8252 11.3639 10.8252H9.19125C7.66903 10.8252 6.43066 12.0635 6.43066 13.5856V14.7747C6.43066 15.1547 6.73874 15.4628 7.11875 15.4628Z" fill="black"/>
        </svg>
    </div>
    <div class="user-block__wrap">
        <div class="user-block__header">
            <div class="user-block__title">Контакты</div>
        </div>
        <div class="user-block__content flex-grow-1">
            <ul class="user-block__items row">
                <li class="user-block-info user-block__item col-12 col-md-6 col-xl-4">
                    <div class="user-block-info__name">Электронная почта</div>
                    <div class="user-block-info__value">
                        <input type="email" class="form-control user-block-info__value--no-change" name="email" value="{{ Auth::user()->email }}" required>
                        <span>{{ Auth::user()->email }}</span>
                    </div>
                </li>
                @include('sellers.personal_data._phones')
            </ul>
            @include('sellers.personal_data._additional_phones')
            @include('sellers.personal_data._additional_social')
        </div>
    </div>
</div>