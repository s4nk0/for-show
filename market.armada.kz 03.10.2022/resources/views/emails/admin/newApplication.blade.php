@extends('emails._layout')

@section('title',"Новая заявка" )

@section('content')
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table cellspacing="0" cellpadding="0"
                       style="width: 100%; max-width: 640px; background: #FFFFFF; border-radius: 20px;">
                    <tr>
                        <td>
                            <!-- HEADER STARTS -->
                            <table width="100%" cellspacing="0" cellpadding="0" border="0"
                                   style="border-bottom: 1px solid #f1f1f1;">
                                <tr>
                                    <td align="left" style="padding: 1rem 2rem;">
                                        <img src="img/logo.png" width="150px" alt="ARMADA" class="header-logo">
                                    </td>
                                    <td align="right" style="font-size: 12px; padding: 1rem 2rem;">
                                        <p style="margin: 0">Торговый комплекс <br> Мебель. Интерьер. Стройматериалы</p>
                                    </td>
                                </tr>
                            </table>
                            <!-- HEADER END -->
                            <!-- CONTENT STARTS -->
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 1rem 2rem;">

                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td>
                                                    <h3>Получена новая заявка</h3>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <div style="padding: 1rem 2rem;">
                                <p class="client-name">
                                    <span>Имя клиента:</span><span>{{$data->name}}</span>
                                </p>
                                <p class="client-store">
                                    <span>Название организации</span> : <span>{{$data->organization}}</span>
                                </p>
                                <p class="client-phone">
                                    <span>Моб.тел клиента</span> : <span><a href="tel:{{$data->phone}}"
                                                                            class="phone">{{$data->phone}}</a></span>
                                </p>
                                <p class="client-website">
                                    <span>Адрес сайта</span> : <span>{{$data->site}}</span>
                                </p>
                                @if($data->type =='advertising')
                                    <span>Вид рекламы:</span><br/>
                                <div style="padding: 0 10px">
                                    @if(isset($data->ad_type1) and $data->ad_type1 == true)
                                        <span>Реклама в торговом комплексе</span><br/>
                                    @endif
                                    @if(isset($data->ad_type2) and $data->ad_type2 == true)
                                        <span>Реклама на сайте</span><br/>
                                    @endif
                                    @if(isset($data->ad_type3) and $data->ad_type3 == true)
                                        <span>Аудио-видео реклама</span><br/>
                                    @endif
                                </div>


                                @elseif($data->type =='rent')
                                    <p class="place">
                                        <span>Необходимый площади от</span> : <span>{{$data->size_from}}</span>
                                        <span>до</span> : <span>{{$data->size_to}}</span>
                                    </p>
                                    <p>
                                        <span>Наименование товара (вид товара):</span>
                                        <br>
                                        <span>{{$data->product_type}}</span>
                                    </p>
                                    <p>
                                        <span>Срок существования на рынке:</span><span>{{$data->lifetime}}</span>
                                    </p>
                                    <p>
                                        <span>Завод производитель товара:</span><span>{{$data->factory}}</span>
                                    </p>
                                    <p>
                                        <span>Представлен ли данный товар в ТК «ARMADA»?</span><span>{{$data->present_type =='yes' ? 'Да' : 'Нет'}}</span>
                                    </p>
                                    <p>
                                        <span>Вы являетесь:</span><span>{{$data->customer_type_id}}</span>
                                    </p>
                                    <p>
                                        <span>Классификация товара:</span><span>{{$data->product_class}}</span>
                                    </p>
                                    <p>
                                        <span>Планируете ли Вы произвести монтажные работы по обустройству и дизайну торговой площади?</span>
                                        <br>
                                        <span>{{$data->assembly_work}}</span>
                                    </p>
                                    <p>
                                        <span>Примечание:</span>
                                        <br>
                                        <span>{{$data->note}}</span>
                                    </p>
                                @endif
                                <p class="client-name date">
                                    <span>Дата создания:</span> <span>{{$data->created_at}}</span>
                                </p>
                            </div>



                        <!-- CONTENT END -->
                            <!-- FOOTER STARTS -->
                            <table width="100%" cellspacing="0" cellpadding="0" border="0"
                                   style="background: #535353; color: #FFFFFF; font-size: 12px; border-radius: 0 0 20px 20px;">
                                <tr>
                                    <td align="left" style="padding: 1rem 2rem;">
                                        <img src="img/logo--white.png" width="100px" alt="">
                                    </td>
                                    <td align="right" style="padding: 1rem 2rem;">
                                        <div>Алматы, ул. Каблова (Марченка) 1.8, ул. Саина</div>
                                        <div style="color: #bfbfbf;">© TK ARMADA, 2020</div>
                                    </td>
                                </tr>
                            </table>
                            <!-- FOOTER END -->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
