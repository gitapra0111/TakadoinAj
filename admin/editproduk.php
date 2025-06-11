<?php if ($produk_edit): ?>
              <div class="edit-form mx-auto">
                  <h4 class="mb-3">Edit Produk</h4>
                  <form method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?= $produk_edit['id'] ?>">
                      <div class="mb-2">
                          <label class="form-label">Nama Produk</label>
                          <input name="nama" value="<?= htmlspecialchars($produk_edit['nama']) ?>" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Harga</label>
                          <input name="harga" value="<?= htmlspecialchars($produk_edit['harga']) ?>" class="form-control" required>
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Status</label>
                          <select name="status" class="form-select">
                              <option value="normal" <?= $produk_edit['status'] == 'normal' ? 'selected' : '' ?>>Normal</option>
                              <option value="sale" <?= $produk_edit['status'] == 'sale' ? 'selected' : '' ?>>Sale</option>
                          </select>
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Harga Diskon</label>
                          <input name="harga_diskon" value="<?= htmlspecialchars($produk_edit['harga_diskon']) ?>" class="form-control">
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Rating</label>
                          <input name="rating" value="<?= htmlspecialchars($produk_edit['rating']) ?>" class="form-control">
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Ganti Gambar (opsional)</label>
                          <input type="file" name="gambar" class="form-control">
                      </div>
                      <div class="mt-3 d-flex gap-2">
                          <button type="submit" name="simpan_edit" class="btn btn-warning">Simpan Perubahan</button>
                          <a href="admin.php" class="btn btn-secondary">Batal</a>
                      </div>
                  </form>
              </div>
              <?php endif; ?>