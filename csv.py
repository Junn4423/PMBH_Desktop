import pandas as pd
import random

columns = [
    'Product Id', 'Product Handle', 'Product Title', 'Product Subtitle',
    'Product Description', 'Product Status', 'Product Thumbnail',
    'Product Weight', 'Product Length', 'Product Width', 'Product Height',
    'Product HS Code', 'Product Origin Country', 'Product MID Code',
    'Product Material', 'Shipping Profile Id', 'Product Sales Channel 1',
    'Product Collection Id', 'Product Type Id', 'Product Tag 1',
    'Product Discountable', 'Product External Id', 'Variant Id',
    'Variant Title', 'Variant SKU', 'Variant Barcode',
    'Variant Allow Backorder', 'Variant Manage Inventory', 'Variant Weight',
    'Variant Length', 'Variant Width', 'Variant Height', 'Variant HS Code',
    'Variant Origin Country', 'Variant MID Code', 'Variant Material',
    'Variant Price EUR', 'Variant Price USD', 'Variant Price VND',
    'Variant Option 1 Name', 'Variant Option 1 Value',
    'Product Image 1 Url', 'Product Image 2 Url'
]

# Dữ liệu tiếng Việt
product_types = [
    'Áo thun', 'Quần jean', 'Áo hoodie', 'Áo len', 'Áo khoác',
    'Đầm', 'Chân váy', 'Quần short', 'Áo sơ mi', 'Áo măng tô'
]

adjectives = [
    'Cổ điển', 'Hiện đại', 'Vintage', 'Năng động',
    'Thoải mái', 'Thanh lịch', 'Đơn giản', 'Thể thao'
]

colors = [
    'Đen', 'Trắng', 'Xanh dương', 'Đỏ', 'Xanh lá',
    'Xám', 'Xanh navy', 'Be', 'Hồng', 'Vàng'
]

sizes = ['S', 'M', 'L', 'XL']
sales_channel_id = 'sc_01KD510HVHM4TBXNM9HG53SJZN'

data = []

for i in range(50):
    p_type = random.choice(product_types)
    adj = random.choice(adjectives)
    color = random.choice(colors)

    title = f"{p_type} {adj} màu {color}"
    handle = f"{p_type}-{adj}-{color}-{i+1}".lower().replace(" ", "-")

    desc = (
        f"{title}. "
        f"Thiết kế {adj.lower()}, phù hợp mặc hằng ngày, "
        f"dễ phối đồ, chất liệu thoáng mát và bền đẹp."
    )

    price_usd = random.randint(20, 100)
    price_eur = int(price_usd * 0.9)
    price_vnd = price_usd * 25000

    weight = random.randint(300, 900)

    img_url = f"https://placehold.co/600x400/png?text={p_type}+{color}"

    current_sizes = sizes if random.choice([True, False]) else [random.choice(sizes)]

    for size in current_sizes:
        data.append({
            'Product Id': '',
            'Product Handle': handle,
            'Product Title': title,
            'Product Subtitle': '',
            'Product Description': desc,
            'Product Status': 'published',
            'Product Thumbnail': img_url,
            'Product Weight': weight,
            'Product Length': '', 'Product Width': '', 'Product Height': '',
            'Product HS Code': '', 'Product Origin Country': 'VN',
            'Product MID Code': '', 'Product Material': '',
            'Shipping Profile Id': '',
            'Product Sales Channel 1': sales_channel_id,
            'Product Collection Id': '',
            'Product Type Id': '',
            'Product Tag 1': 'thoi-trang',
            'Product Discountable': 'TRUE',
            'Product External Id': '',
            'Variant Id': '',
            'Variant Title': size,
            'Variant SKU': f"SKU-{handle}-{size}",
            'Variant Barcode': '',
            'Variant Allow Backorder': 'FALSE',
            'Variant Manage Inventory': 'TRUE',
            'Variant Weight': weight,
            'Variant Length': '', 'Variant Width': '', 'Variant Height': '',
            'Variant HS Code': '', 'Variant Origin Country': 'VN',
            'Variant MID Code': '', 'Variant Material': '',
            'Variant Price EUR': price_eur,
            'Variant Price USD': price_usd,
            'Variant Price VND': price_vnd,
            'Variant Option 1 Name': 'Size',
            'Variant Option 1 Value': size,
            'Product Image 1 Url': img_url,
            'Product Image 2 Url': ''
        })

df = pd.DataFrame(data)[columns]
output_filename = 'san_pham_thoi_trang_tieng_viet.csv'
df.to_csv(output_filename, index=False)

print(f"Đã tạo file: {output_filename} | Tổng dòng: {len(df)}")
