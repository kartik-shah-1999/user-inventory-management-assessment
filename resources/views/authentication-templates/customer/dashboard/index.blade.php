@section('title','Customer Dashboard')

<x-header />

<x-dashboard.header />

<x-dashboard.products :publishedProducts=$publishedProducts />

<x-footer />