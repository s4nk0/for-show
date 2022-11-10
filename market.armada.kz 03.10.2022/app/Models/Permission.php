<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AddEdit;

class Permission extends Model
{
    use HasFactory;
    //use AddEdit;
    protected $table = 'permissions';

    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'roles_permissions');
    }

    const BROWSE_PANEL='browse_panel';
    const BROWSE_ADMINS='browse_admins';
    const BROWSE_USERS='browse_users';
    const BROWSE_SELLERS='browse_sellers';
    const BROWSE_STORES='browse_stores';
    const BROWSE_PRODUCTS='browse_products';
    const BROWSE_ORDERS='browse_orders';
    const BROWSE_CATALOGS='browse_catalogs';
    const BROWSE_PAGES='browse_pages';
    const BROWSE_BANNERS='browse_banners';
    const BROWSE_FAQS='browse_faqs';
    const BROWSE_NEWS='browse_news';
    const BROWSE_BLOGS='browse_blogs';
    const BROWSE_SUBSCRIPTIONS='browse_subscriptions';
    const BROWSE_MAPS='browse_maps';
    const BROWSE_VIDEO='browse_video';
    const BROWSE_JOURNALS='browse_journals';
    const BROWSE_MEDIA='browse_media';
    const BROWSE_PUBLICATIONS='browse_publications';
    const BROWSE_APPLICATIONS='browse_applications';
    const BROWSE_REVIEWS='browse_reviews';
    const BROWSE_RATES='browse_rates';
    const BROWSE_ANALYTICS='browse_analytics';
    const BROWSE_MESSAGES='messages';
    const BROWSE_COLORS='browse_colors';
    const BROWSE_COUNTRIES='browse_countries';
    const BROWSE_CITIES='browse_cities';
    const BROWSE_TARIFS='browse_tarifs';
    const BROWSE_ROLES='browse_roles';
    const BROWSE_PERMISSIONS='browse_permissions';

    //browse_countries
    //browse_cities
    //browse_tarifs
    //browse_roles
    //browse_permissions




//browse_media
//browse_publications
//browse_applications
//browse_reviews
//browse_rates
//browse_analytics
//browse_messages

}
